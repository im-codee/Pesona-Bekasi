<?php

if (!function_exists('getOS')) {
    function getOS($userAgent) {
        $userAgent = strtolower($userAgent);

        $osArray = [
            'Windows 11'   => '/windows nt 10.0;.*win64/i',
            'Windows 10'   => '/windows nt 10.0/i',
            'Windows 8.1'  => '/windows nt 6.3/i',
            'Windows 8'    => '/windows nt 6.2/i',
            'Windows 7'    => '/windows nt 6.1/i',
            'Windows XP'   => '/windows nt 5.1/i',
            'MacOS'        => '/macintosh|mac os x/i',
            'Linux'        => '/linux/i',
            'Ubuntu'       => '/ubuntu/i',
            'Android'      => '/android/i',
            'iOS'          => '/iphone|ipad|ipod/i',
            'Chrome OS'    => '/cros/i',
        ];

        foreach ($osArray as $os => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $os;
            }
        }

        return 'Tidak Diketahui';
    }
}

if (!function_exists('getBrowser')) {
    function getBrowser($userAgent) {
        $userAgent = strtolower($userAgent);

        $browserArray = [
            'Google Chrome'    => '/chrome/i',
            'Mozilla Firefox'  => '/firefox/i',
            'Apple Safari'     => '/safari/i',
            'Microsoft Edge'   => '/edg/i',
            'Opera'            => '/opera|opr/i',
            'Internet Explorer' => '/msie|trident/i',
            'Brave'            => '/brave/i',
        ];

        foreach ($browserArray as $browser => $pattern) {
            if (preg_match($pattern, $userAgent)) {
                return $browser;
            }
        }

        return 'Tidak Diketahui';
    }
}
