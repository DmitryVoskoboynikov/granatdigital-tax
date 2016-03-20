<?php
namespace app\actions\api;

use app\core\repository\DispatcherRepositoryTrait;
use app\models\Group;
use app\models\User;
use yii\helpers\Json;
use yii\web\ConflictHttpException;

class DispatcherApiAction extends AbstractApiAction
{
    use DispatcherRepositoryTrait;

    /**
     * @return string
     */
    protected function get()
    {
        $params = $this->getApiRequest()->getParams();

        if (isset($params['id'])) {
            $user = $this->getDispatcherById($params['id']);
            $response = $user->getDto();
        } else {
            $response = User::find()->dispatcherDtoCollection();
        }

        return Json::encode($response);
    }

    /**
     * @return string
     */
    protected function create()
    {
        $data = $this->getApiRequest()->getBody();

        $this->handlePhone($data['phone']);

        $user = new User();
        //$driver->company_id = \Yii::$app->user->getCompanyId();
        $user->group_id = Group::DISPATCHER;

        if (isset($data['first_name'])) {
            $user->first_name = $data['first_name'];
        }

        if (isset($data['second_name'])) {
            $user->second_name = $data['second_name'];
        }

        if (isset($data['last_name'])) {
            $user->last_name = $data['last_name'];
        }

        $user->phone = $data['phone'];
        $user->password = md5(time());
        $user->save();

        return Json::encode($user->getDriverDto());
    }

    /**
     * @return string
     */
    protected function update()
    {
        $data = $this->getApiRequest()->getBody();
        $params = $this->getApiRequest()->getParams();
        $id = $params['id'];

        $this->handlePhone($data['phone']);

        $user = $this->getDispatcherById($id);

        if (isset($data['first_name'])) {
            $user->first_name = $data['first_name'];
        }

        if (isset($data['second_name'])) {
            $user->second_name = $data['second_name'];
        }

        if (isset($data['last_name'])) {
            $user->last_name = $data['last_name'];
        }

        if (isset($data['phone'])) {
            $user->phone = $data['phone'];
        }

        $user->save();

        return Json::encode($user->getDto());
    }

    /**
     * @return string
     */
    protected function delete()
    {
        $params = $this->getApiRequest()->getParams();
        $id = $params['id'];

        $user = $this->getDispatcherById($id);
        $user->markAsDeleted();
        $user->save();
    }

    /**
     * @param $phone
     * @throws ConflictHttpException
     * todo move to client phone validator
     */
    private function handlePhone($phone)
    {
        if (null !== User::find()->byPhone($phone)->one()) {
            throw new ConflictHttpException('phone already use');
        }
    }
}
