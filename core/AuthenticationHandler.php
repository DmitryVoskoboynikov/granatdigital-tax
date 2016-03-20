<?php

namespace app\core;

use app\models\User;
use yii\web\ForbiddenHttpException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru-RU>
 */
class AuthenticationHandler
{
    /**
     * @param ApiRequest $apiRequest
     * @return User|array|null
     * @throws ForbiddenHttpException
     */
    public function handle(ApiRequest $apiRequest)
    {
        if (YII_ENV_DEV) {
            return;
        }

        $headers = $apiRequest->getHeaders();
        $apiKey = $headers->get('apiKey');

        $userId = \Yii::$app->cache->get($apiKey);

        if (!\Yii::$app->cache->exists($apiKey)) {
            throw new ForbiddenHttpException();
        }

        \Yii::$app->cache->set($apiKey, $userId, \Yii::$app->params['userTokenTTL']);

        $user = User::find(['id' => $userId])->one();

        \Yii::$app->user->setIdentity($user);
    }
}