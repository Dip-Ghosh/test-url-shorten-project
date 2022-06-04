<?php

namespace App\Service;

class UrlService
{
    function generateRandomString($request): string
    {
        $characters = preg_replace("(^https?://)", "", $request );
        $length = 5;
        $charactersLength = strlen(preg_replace("(^https?://)", "", $request));
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
