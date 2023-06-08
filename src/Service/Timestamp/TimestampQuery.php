<?php

namespace FluxIliasRestApi\Service\Timestamp;

use DateTime;
use DateTimeZone;

trait TimestampQuery
{

    private function convertDateTimeStringToTimestamp(?string $date_time) : ?float
    {
        if (($date_time ?? "") === "") {
            return null;
        }

        return (new DateTime($date_time, new DateTimeZone("UTC")))->format("U.u");
    }


    private function convertTimestampToDateTimeString(?float $timestamp) : ?string
    {
        if ($timestamp === null) {
            return null;
        }

        return DateTime::createFromFormat("U.u", number_format($timestamp, 6, ".", ""), new DateTimeZone("UTC"))->format("Y-m-d H:i:s.u");
    }
}
