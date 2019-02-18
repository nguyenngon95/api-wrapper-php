<?php

namespace Uiza;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Base {

    public static $apiSubdomain;

    public static $apiKey;

    public static $apiBase;

    public static $apiVersion = 'v3';

    public static $logger = null;

    const VERSION = '1.0';

    public static function setApiKey(string $apiKey)
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @return string The API key used for requests.
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    public static function setApiSubdomain(string $apiSubdomain)
    {
        self::$apiSubdomain = $apiSubdomain;
        self::$apiBase = 'https://' . self::$apiSubdomain . '.uiza.co';
    }

    public static function getBaseUrl()
    {
        return self::$apiBase . '/api/public/' . self::$apiVersion;
    }

    /**
     * @return string The API version used for requests. null if we're using the
     *    latest version.
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }
    /**
     * @param string $apiVersion The API version to use for requests.
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return Util\LoggerInterface The logger to which the library will
     *   produce messages.
     */
    public static function getLogger()
    {
        if (self::$logger == null) {
            // Create the logger
            self::$logger = new Logger('Uiza');
            // Now add some handlers
            self::$logger->pushHandler(new StreamHandler(__DIR__.'/../storage/my_app.log', Logger::DEBUG));
        }

        return self::$logger;
    }

    /**
     * @param Util\LoggerInterface $logger The logger to which the library
     *   will produce messages.
     */
    public static function setLogger($logger)
    {
        self::$logger = $logger;
    }
}
