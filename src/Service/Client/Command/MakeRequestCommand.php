<?php

namespace FluxIliasRestApi\Service\Client\Command;

use CURLFile;
use CurlHandle;
use Exception;
use FluxIliasRestApi\Adapter\Body\FormDataBodyDto;
use FluxIliasRestApi\Adapter\Body\RawBodyDto;
use FluxIliasRestApi\Adapter\Client\ClientRequestDto;
use FluxIliasRestApi\Adapter\Client\ClientResponseDto;
use FluxIliasRestApi\Adapter\Header\DefaultHeaderKey;
use FluxIliasRestApi\Adapter\Status\CustomStatus;
use FluxIliasRestApi\Service\Body\Port\BodyService;
use LogicException;

class MakeRequestCommand
{

    private function __construct(
        private readonly BodyService $body_service
    ) {

    }


    public static function new(
        BodyService $body_service
    ) : static {
        return new static(
            $body_service
        );
    }


    public function makeRequest(ClientRequestDto $request) : ?ClientResponseDto
    {
        $curl = null;
        $file = null;
        try {
            $headers = $request->headers;

            $url = $request->url;

            if ($request->params !== null) {
                foreach ($request->params as $name => $value) {
                    if (is_bool($value)) {
                        $value = json_encode($value);
                    }
                    if (is_object($value) && property_exists($value, "value")) {
                        $value = $value->value;
                    }
                    $url = str_replace("{" . $name . "}", rawurlencode($value), $url);
                }
            }

            if (!empty($request->query_params)) {
                foreach ($request->query_params as $name => $value) {
                    if ($value === null) {
                        continue;
                    }
                    if (is_bool($value)) {
                        $value = json_encode($value);
                    }
                    if (is_object($value) && property_exists($value, "value")) {
                        $value = $value->value;
                    }
                    $url .= (str_contains($url, "?") ? "&" : "?") . rawurlencode($name) . "=" . rawurlencode($value);
                }
            }

            $curl = curl_init($url);

            if ($request->fail_on_status_400_or_higher) {
                curl_setopt($curl, CURLOPT_FAILONERROR, true);
            }

            if ($request->follow_redirect) {
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            }

            if ($request->trust_self_signed_certificate) {
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_PROXY_SSL_VERIFYHOST, false);
            }

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $request->method->value);

            if ((($request->raw_body !== null) + ($request->parsed_body !== null) + ($request->file !== null)) > 1) {
                throw new LogicException("Can't set multiple raw body or parsed body or file");
            }
            if ($request->raw_body !== null) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $request->raw_body);
            }
            if ($request->parsed_body !== null) {
                if ($request->parsed_body instanceof FormDataBodyDto) {
                    if (!array_key_exists(DefaultHeaderKey::CONTENT_TYPE->value, $headers)) {
                        $headers[DefaultHeaderKey::CONTENT_TYPE->value] = $request->parsed_body->getType()->value;
                    }
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $request->parsed_body->data + array_map(fn(string $file) : CURLFile => new CURLFile($file), $request->parsed_body->files));
                } else {
                    $raw_body = $this->body_service->toRawBody(
                        $request->parsed_body
                    );
                    if (!array_key_exists(DefaultHeaderKey::CONTENT_TYPE->value, $headers)) {
                        $headers[DefaultHeaderKey::CONTENT_TYPE->value] = $raw_body->type;
                    }
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $raw_body->body);
                }
            }
            if ($request->file !== null) {
                if (!array_key_exists(DefaultHeaderKey::CONTENT_TYPE->value, $headers)) {
                    $headers[DefaultHeaderKey::CONTENT_TYPE->value] = mime_content_type($request->file);
                }
                curl_setopt($curl, CURLOPT_PUT, true);
                curl_setopt($curl, CURLOPT_INFILESIZE, filesize($request->file));
                $file = fopen($request->file, "r");
                curl_setopt($curl, CURLOPT_INFILE, $file);
            }

            if (!empty($headers)) {
                curl_setopt($curl, CURLOPT_HTTPHEADER, array_map(fn(string $key, string $value) : string => $key . ":" . $value, array_keys($headers), $headers));
            }

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = [];
            if ($request->response) {
                curl_setopt($curl, CURLOPT_HEADERFUNCTION, function (CurlHandle $curl, string $header) use (&$headers) : int {
                    $len = strlen($header);

                    $header = array_filter(array_map("trim", explode(":", $header, 2)));

                    if (count($header) === 2) {
                        $headers[$header[0]] = $header[1];
                    }

                    return $len;
                });
            }

            $body = curl_exec($curl);

            $error_code = curl_errno($curl);
            if ($error_code !== 0) {
                throw new Exception(curl_error($curl), $error_code);
            }

            if ($request->response) {
                $response = ClientResponseDto::new(
                    CustomStatus::factory(
                        curl_getinfo($curl, CURLINFO_HTTP_CODE)
                    ),
                    $headers,
                    $body
                );

                if ($request->parse_response_body) {
                    $response = ClientResponseDto::new(
                        $response->status,
                        $response->headers,
                        $response->raw_body,
                        $this->body_service->parseBody(
                            RawBodyDto::new(
                                $response->getHeader(
                                    DefaultHeaderKey::CONTENT_TYPE
                                ),
                                $response->raw_body
                            )
                        )
                    );
                }

                return $response;
            } else {
                return null;
            }
        } finally {
            if ($curl !== null) {
                curl_close($curl);
            }
            if (is_resource($file)) {
                fclose($file);
            }
        }
    }
}
