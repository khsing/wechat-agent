<?php

namespace Khsing\WechatAgent;

use Jenssegers\Agent\Agent;

class WechatAgent extends Agent
{
    private static $wechatProperties = [
        'Wechat' => 'MicroMessenger/[VER]',
        'MQQBrowser' => 'MQQBrowser/[VER]',
    ];

    private static $wechatBrowsers = [
        'Wechat' => 'MicroMessenger',
        'MQQBrowser' => 'MQQBrowser',
    ];

    public function __construct()
    {
        static::$additionalProperties = array_merge(
            static::$wechatProperties,
            parent::$additionalProperties
        );

        static::$additionalBrowsers = array_merge(
            static::$wechatBrowsers,
            parent::$additionalBrowsers
        );

        parent::__construct();
    }

    /**
     * Compare version of wechat
     *
     * @param string $version
     * @param string $opeartor
     * @return bool|int
     */
    public function version_compare($ident, $version, $opeartor=null)
    {
        $orig_version = $this->version($ident) ? $this->version($ident) : "UnknownVersion";
        if ($opeartor) {
            return version_compare($orig_version, $version, $opeartor);
        }
        return version_compare($orig_version, $version);
    }

    /**
     * Return network type of wechat using
     *
     * @return string|bool
     */
    public function nettype()
    {
        preg_match("/NetType\/([\w.-_]+)/", $this->userAgent, $match);
        if (false === empty($match[1])) {
            return $match[1];
        }
        return false;
    }
}
