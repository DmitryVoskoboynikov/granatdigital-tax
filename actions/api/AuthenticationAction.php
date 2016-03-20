<?php

namespace app\actions\api;

use app\core\ApiRequest;
use app\models\User;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru-RU>
 */
class AuthenticationAction extends Action
{
    /**
     * @return string
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function run()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $apiRequest = new ApiRequest();
        $data = $apiRequest->getBody();

//        if (!$this->validate($data)) {
//            throw new BadRequestHttpException();
//        }

        $user = $this->findUserByLogin($data['login']);

        if (md5($data['password']) !== $user->password) {
            throw new ForbiddenHttpException();
        }

        $token = $user->generateToken();
        \Yii::$app->cache->set($token, $user->id, \Yii::$app->params['userTokenTTL']);

        \Yii::info(['userId' => $user->id, 'token' => $token], 'login');

        return $token;
    }

    /**
     * @return bool
     */
    protected function needAuthentication()
    {
        return false;
    }

    /**
     * @param string $login
     * @return User
     * @throws NotFoundHttpException
     */
    private function findUserByLogin($login)
    {
        $user = User::find()->byLogin($login)->one();

        if (!$user) {
            throw new NotFoundHttpException();
        }

        return $user;
    }
}
