<?php

namespace FluxIliasRestApi\Service\Proxy\Command;

use FluxIliasRestApi\Service\ProxyConfig\Port\ProxyConfigService;
use ilGlobalTemplateInterface;
use ILIAS\UICore\PageContentProvider;

class GetWebProxyCommand
{

    private function __construct(
        private readonly ProxyConfigService $proxy_config_service,
        private readonly ilGlobalTemplateInterface $ilias_global_template
    ) {

    }


    public static function new(
        ProxyConfigService $proxy_config_service,
        ilGlobalTemplateInterface $ilias_global_template
    ) : static {
        return new static(
            $proxy_config_service,
            $ilias_global_template
        );
    }


    public function getWebProxy(
        string $url,
        ?string $page_title = null,
        ?string $short_title = null,
        ?string $view_title = null,
        ?string $route = null,
        ?array $query_params = null,
        ?string $original_route = null,
        ?string $permanent_link = null
    ) : string {
        $url = rtrim($url, "/") . (!empty($route = trim($route, "/")) ? "/" . $route : "");

        if (!empty($query_params)) {
            $url .= (str_contains($url, "?") ? "&" : "?") . implode("&",
                    array_map(fn(string $key, string $value) : string => rawurlencode($key) . "=" . rawurlencode($value), array_keys($query_params), $query_params));
        }

        $this->ilias_global_template->loadStandardTemplate();

        PageContentProvider::setTitle($page_title ?? "");
        PageContentProvider::setShortTitle($short_title ?? "");
        PageContentProvider::setViewTitle($view_title ?? "");

        if ($permanent_link !== null) {
            if (!str_contains($permanent_link, "://")) {
                $permanent_link = ILIAS_HTTP_PATH . "/" . ltrim($permanent_link, "/");
            }
            PageContentProvider::setPermaLink($permanent_link);
        }

        $this->ilias_global_template->setLocator();

        $this->ilias_global_template->setContent("%CONTENT%");

        $html = $this->ilias_global_template->printToString();

        $html = str_replace("<head>", <<<EOL
            <head>
                <base href="/">
            EOL, $html);

        if (!str_ends_with($original_route, "/goto.php")) {
            $html = str_replace("/" . trim($original_route, "/") . "/", "/", $html);
        }

        $iframe_offset_height = htmlspecialchars($this->proxy_config_service->getWebProxyIframeHeightOffset() . "px");
        $src = htmlspecialchars($url);

        return str_replace("%CONTENT%", <<<EOL
            <link href="flux-ilias-rest-web-proxy/ui/css/flilre_web_proxy.css" rel="stylesheet">
            <iframe id="flilre_web_proxy_iframe" src="$src" style="--FLUX_ILIAS_REST_WEB_PROXY_IFRAME_HEIGHT_OFFSET:$iframe_offset_height"></iframe>
            EOL, $html);
    }
}
