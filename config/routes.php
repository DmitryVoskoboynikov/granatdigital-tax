<?php

return [
    '<controller>/<action>.<_format>' => '<controller>/<action>',
    '/signup'                         => 'site/signup',
    '/admin'                          => 'admin/admin/index',
    '/admin/settings'                 => 'admin/settings/index',
    '/admin/companies'                => 'admin/companies/index',
    '/admin/managers'                 => 'admin/managers/index',

    /**api server*/
    'api/server/api-key/check' => 'api/serverApiKey',
    /***/
     
    /**api order*/
    'api/orders/<id:\d+>' => 'api/orders',
    'api/orders/<id:\d+>/history' => 'api/orderHistory',

    'api/orders/<orderId:\d+>/messages' => 'api/orderMessage',
    'api/orders/<orderId:\d+>/messages/<id:\d+>' => 'api/orderMessage',

    'api/orders/<orderId:\d+>/transition' => 'api/orderTransition',

    'api/orders/<orderId:\d+>/car' => 'api/orderCar',
    /***/

    /**api clients*/
    'api/clients/<id:\d+>' => 'api/clients',
    'api/clients/<clientId:\d+>/messages' => 'api/clientMessage',
    'api/clients/<clientId:\d+>/messages/<id:\d+>' => 'api/clientMessage',
    /***/

    /**api drivers*/
    'api/drivers/<id:\d+>' => 'api/drivers',
    'api/drivers/<id:\d+>/block' => 'api/driverBlock',
    'api/drivers/<driverId:\d+>/cars' => 'api/driverCars',
    'api/drivers/<driverId:\d+>/cars/<id:\d+>' => 'api/driverCars',
    /***/

    /**api dispatchers*/
    'api/dispatchers/<id:\d+>' => 'api/dispatchers',
    'api/dispatchers/<id:\d+>/block' => 'api/dispatcherBlock',
    /***/

    /**api companies*/
    'api/companies/<id:\d+>' => 'api/companies',
    'api/companies/<id:\d+>/settings' => 'api/companySettings',
    /***/
];