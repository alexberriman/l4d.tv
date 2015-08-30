<?php
namespace backend\themes\remark\assets;

use yii\web\AssetBundle;

/**
 * Class LoginAsset
 * @package backend\themes\remark\assets
 */
class LoginAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@app/themes/remark/web';

    /**
     * @var array
     */
    public $css = [
        'examples/css/pages/login-v2.css',
    ];

    /**
     * @var array
     */
    public $js = [
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
