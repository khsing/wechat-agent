# Intro
Detect wechat user agent and compare version

This package based on [jenssegers/agent](https://github.com/jenssegers/agent), so that all functions are compatible. 

# Usage

* Detect wechat user agent
```php
use Khsing\WechatAgent\WechatAgent;
$agent = new WechatAgent;

$agent->is("Wechat"); // return true or false 

```
* Get version of wechat

```
$agent->version("Wechat");
```
* Compare version
```php
$agent->version_compare("Wechat", "6.6.3"); // return -1 if lower than 6.6.3, return 0 if equal, return 1 if greater than 6.6.3
$agent->version_compare("Wechat", "6.6.1", ">="); // return true if greater than 6.6.1
```
* Get network type
```php
$agent->nettype() // return 4G/WIFI etc.
```

Thanks
