<?php

if (!function_exists('decodePayload')) {
    function decodePayload($signedPayload)
    {
        $tokenParts = explode(".", $signedPayload);
        return json_decode(base64_decode($tokenParts[1]));
    }
}
