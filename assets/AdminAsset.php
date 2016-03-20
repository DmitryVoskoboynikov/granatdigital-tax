<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Asset for admin pages.
 *
 * @author Dmitry Voskoboynikov <voskoboynikov@granat-digital.ru>
 */
class AdminAsset extends AssetBundle
{
    /** @var string  Source path */
    public $sourcePath = '@app/modules/admin';
    public $baseUrl = '@web';

    /** @var array Contain css styles. */
    public $css = [
        'assets/css/bootstrap.min.css',
        'assets/css/sb-admin.css',
        'assets/css/plugins/morris.css',
        'assets/font-awesome/css/font-awesome.min.css',
    ];

    /** @var array Contain js styles. */
    public $js = [
        'assets/js/bootstrap.min.js',
    ];

    /** @var array Assets publish options */
    public $publishOptions = [
        'forceCopy' => true,
    ];

    /** @var array Contain depended assets */
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
