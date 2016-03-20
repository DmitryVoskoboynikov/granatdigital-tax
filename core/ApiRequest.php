<?php

namespace app\core;

use yii\helpers\Json;
use yii\web\HeaderCollection;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru-RU>
 */
class ApiRequest
{
    const CONTENT_TYPE_JSON = 'application/json';

    /**
     * @var HeaderCollection
     */
    private $headers;

    /**
     * @var array
     */
    private $body;

    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $method;

    public function __construct()
    {
        $request = \Yii::$app->getRequest();
        $this->headers = $request->headers;
        $this->method = $request->getMethod();
        $this->params = $request->getQueryParams();

        if ($request->getContentType() == self::CONTENT_TYPE_JSON) {
            $this->body = $request->getBodyParams();
        } else {
            $this->body = Json::decode($request->getRawBody());
        }
    }

    /**
     * @return HeaderCollection
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}