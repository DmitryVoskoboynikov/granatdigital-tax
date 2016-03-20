<?php

namespace app\actions\api;

use app\core\ApiRequest;
use app\core\AuthenticationHandler;
use yii\base\Action;
use yii\web\ForbiddenHttpException;
use yii\web\MethodNotAllowedHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru-RU>
 */
abstract class AbstractApiAction extends Action
{
    /**
     * @var ApiRequest
     */
    private $apiRequest;

    /**
     * @return string
     */
    abstract protected function get();

    /**
     * @return string
     */
    abstract protected function create();

    /**
     * @return string
     */
    abstract protected function update();

    /**
     * @return string
     */
    abstract protected function delete();

    public function run()
    {
        \Yii::$app->response->headers->add('Access-Control-Allow-Origin', '*');
        \Yii::$app->response->headers->add('Access-Control-Allow-Methods', 'POST, GET, DELETE, PATCH');

        switch ($this->getApiRequest()->getMethod()) {
            case 'GET':
                \Yii::$app->response->content = $this->get();
                \Yii::$app->response->statusCode = 200;
                break;
            case 'POST':
                \Yii::$app->response->content = $this->create();
                \Yii::$app->response->statusCode = 201;
                break;
            case 'PATCH':
                \Yii::$app->response->content = $this->update();
                \Yii::$app->response->statusCode = 200;
                break;
            case 'DELETE':
                $this->delete();
                \Yii::$app->response->statusCode = 204;
                break;
            case 'OPTIONS':
                \Yii::$app->response->statusCode = 200;
                break;
            default:
                throw new MethodNotAllowedHttpException();
                break;
        }
    }

    /**
     * @return ApiRequest
     */
    protected function getApiRequest()
    {
        return $this->apiRequest;
    }

    /**
     * @return bool
     */
    protected function needAuthentication()
    {
        return true;
    }

    /**
     * @return bool
     * @throws ForbiddenHttpException
     */
    protected function beforeRun()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $apiRequest = new ApiRequest();

        if ($this->needAuthentication()) {
            $handler = new AuthenticationHandler();
            $handler->handle($apiRequest);
        }

        $this->apiRequest = $apiRequest;

        return parent::beforeRun();
    }

    /**
     * @param array $data
     * @return bool
     */
    protected function validate($data)
    {
        return true;
    }
}
