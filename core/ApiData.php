<?php
error_reporting(1);

require_once("../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable("../");
$dotenv->load();

$api_uri = $_ENV['API_LINK'];

use MaxMind\Db\Reader;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;


function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = '45.126.185.235';
    return $ipaddress;
}

function get_device()
{
    AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

    $ua = $_SERVER['HTTP_USER_AGENT'];

    $dd = new DeviceDetector($ua);
    $dd->parse();
    $device = $dd->getDeviceName();

    return $device;
}

function get_country()
{
    $ip = get_client_ip();
    $reader = new Reader('../core/GeoLite2-City.mmdb');
    $record = $reader->get($ip);
    $country = $record['country']['names']['en'];
    return $country;
}

function getCurrentURL()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $port = $_SERVER['SERVER_PORT'];
    $url = $protocol . $host;
    if ($_ENV['NODE_ENV'] !== "development") {
        if (($protocol === 'http://' && $port !== 80) || ($protocol === 'https://' && $port !== 443)) {
            $url .= ':' . $port;
        }
    }

    return $url;
}
