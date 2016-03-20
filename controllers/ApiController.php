<?php

namespace app\controllers;

use app\actions\api\AuthenticationAction;
use app\actions\api\ClientMessageApiAction;
use app\actions\api\ClientsApiAction;
use app\actions\api\CompaniesApiAction;
use app\actions\api\CompanySettingsApiAction;
use app\actions\api\DispatcherApiAction;
use app\actions\api\DispatcherBlockApiAction;
use app\actions\api\DriverBlockApiAction;
use app\actions\api\DriverCarsApiAction;
use app\actions\api\DriversApiAction;
use app\actions\api\OrderCarApiAction;
use app\actions\api\OrderMessageApiAction;
use app\actions\api\OrdersApiAction;
use app\actions\api\OrderHistoryApiAction;
use app\actions\api\OrderTransitionApiAction;
use app\actions\api\ServerApiKeyApiAction;
use yii\rest\Controller;

/**
 * @author Kudryashov Mikhail <kudryashov@granat-digital.ru-RU>
 */
class ApiController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'authentication' => [
                'class' => AuthenticationAction::className(),
            ],
            'orders' => [
                'class' => OrdersApiAction::className(),
            ],
            'orderHistory' => [
                'class' => OrderHistoryApiAction::className(),
            ],
            'orderMessage' => [
                'class' => OrderMessageApiAction::className(),
            ],
            'orderTransition' => [
                'class' => OrderTransitionApiAction::className(),
            ],
            'orderCar' => [
                'class' => OrderCarApiAction::className(),
            ],
            'clients' => [
                'class' => ClientsApiAction::className(),
            ],
            'clientMessage' => [
                'class' => ClientMessageApiAction::className(),
            ],
            'drivers' => [
                'class' => DriversApiAction::className(),
            ],
            'driverBlock' => [
                'class' => DriverBlockApiAction::className(),
            ],
            'driverCars' => [
                'class' => DriverCarsApiAction::className(),
            ],
            'dispatchers' => [
                'class' => DispatcherApiAction::className(),
            ],
            'dispatcherBlock' => [
                'class' => DispatcherBlockApiAction::className(),
            ],
            'companies' => [
                'class' => CompaniesApiAction::className(),
            ],
            'companySittings' => [
                'class' => CompanySettingsApiAction::className(),
            ],
            'serverApiKey' => [
                'class' => ServerApiKeyApiAction::className(),
            ],
        ];
    }

    /**
     * @return array
     */
    protected function verbs()
    {
        return [
            'authentication' => ['post'],
            'orders' => ['post', 'get', 'options', 'delete', 'patch'],
            'orderHistory' => ['get', 'options'],
            'orderMessage' => ['post', 'get', 'options', 'delete', 'patch'],
            'orderTransition' => ['post'],
            'orderCar' => ['post', 'patch', 'delete'],
            'clients' => ['get', 'options', 'post', 'patch', 'delete'],
            'clientMessage' => ['get', 'options', 'post', 'patch', 'delete'],
            'drivers' => ['get', 'options', 'post', 'patch', 'delete'],
            'driverCars' => ['get', 'options', 'post', 'patch', 'delete'],
            'driverBlock' => ['post'],
            'dispatchers' => ['get', 'options', 'post', 'patch', 'delete'],
            'dispatcherBlock' => ['post'],
            'companies' => ['get'],
            'serverToken' => ['get'],
        ];
    }
}
