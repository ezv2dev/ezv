<?php

namespace App\Services;

class DeviceCheckService
{
    private static function UserAgentRegCheck($regText)
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        if ($useragent) {
            return preg_match('@('.$regText.')@', $useragent);
        }
        return false;
    }

    public static function isIphone() {
        return self::UserAgentRegCheck('iPad|iPod|iPhone');
    }

    public static function isAndroid() {
        return self::UserAgentRegCheck('Android');
    }

    public static function isDesktop() {
        return self::UserAgentRegCheck('Windows|Macintosh');
    }

    public static function isMobile(){
        return self::UserAgentRegCheck('iPad|iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS');
    }
}
