<?php
use Khsing\WechatAgent\WechatAgent;
use PHPUnit\Framework\TestCase;

class WechatAgentTest extends TestCase
{
    private $wechats = [
        "Mozilla/5.0 (Linux; Android 7.0; MHA-AL00 Build/HUAWEIMHA-AL00; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/6.2 TBS/043906 Mobile Safari/537.36 MicroMessenger/6.6.1.1220(0x26060135) NetType/4G Language/zh_CN" => [
            "browser"=>"Wechat",
            "nettype"=>"4G",
            "os"=>"AndroidOS",
            "version"=>"6.6.1.1220"
        ],
        "Mozilla/5.0 (iPhone; CPU iPhone OS 11_1_2 like Mac OS X) AppleWebKit/604.3.5 (KHTML, like Gecko) Mobile/15B202 MicroMessenger/6.6.1 NetType/WIFI Language/zh_CN" => [
            "browser"=>"Wechat",
            "nettype"=>"WIFI",
            "os"=>"iOS",
            "version"=>"6.6.1",
        ]
    ];
    public function testWechatBrowsers()
    {
        $agent = new WechatAgent;
        foreach ($this->wechats as $ua => $result) {
            $agent->setUserAgent($ua);
            $this->assertEquals($result["browser"], $agent->browser(), $ua);
            $this->assertTrue($agent->is($result["browser"]), $result["browser"]);
        }
    }

    public function testWechatNettype()
    {
        $agent = new WechatAgent;
        foreach ($this->wechats as $ua => $result) {
            $agent->setUserAgent($ua);
            $this->assertEquals($result["nettype"], $agent->nettype(), $ua);
        }
    }

    public function testWechatVersion()
    {
        $agent = new WechatAgent;
        foreach ($this->wechats as $ua => $result) {
            $agent->setUserAgent($ua);
            $this->assertEquals($result["version"], $agent->version("Wechat"), $ua);
            $this->assertEquals(1, $agent->version_compare("Wechat", "6.6.0"), $ua);
            $this->assertEquals(-1, $agent->version_compare("Wechat", "8.6.0"), $ua);
            $this->assertEquals(0, $agent->version_compare("Wechat", $result["version"]), $ua);
            $this->assertTrue($agent->version_compare("Wechat", $result["version"], "="), $ua);
        }
    }

    public function testOS()
    {
        $agent = new WechatAgent;
        foreach ($this->wechats as $ua => $result) {
            $agent->setUserAgent($ua);
            $this->assertEquals($result["os"], $agent->platform(), $ua);
        }
    }
}
