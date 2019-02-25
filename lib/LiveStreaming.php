<?php

namespace Uiza;

class LiveStreaming extends ApiResource
{
    use \Uiza\ApiOperation\Create;

    /**
     * @return string The endpoint URL for the given class.
     */
    public static function classUrl()
    {
        return "/live/entity";
    }

    public static function resourceUrl()
    {
        return Base::getBaseUrl() . self::classUrl();
    }

    public static function startFeed($params = [])
    {
        self::_validateParams('StartFeed', $params);
        $url = static::resourceUrl() . '/feed';
        $response = static::_staticRequest('POST', $url, $params);

        $instance = new static($params['id']);
        $instance->refreshFrom($response->body);
        $instance->setLastResponse($response);

        return $instance;
    }
}
