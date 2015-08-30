<?php
namespace backend\themes\remark\assets;

use yii\web\AssetBundle;

/**
 * Class ThemeAsset
 * @package backend\themes\remark\assets
 */
class ThemeAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@app/themes/remark/web';

    /**
     * @var array
     */
    public $css = [
        'css/bootstrap.min.css',
        'css/bootstrap-extend.min.css',
        'css/site.min.css',
        'fonts/web-icons/web-icons.min.css',
        'fonts/brand-icons/brand-icons.min.css',
        '//fonts.googleapis.com/css?family=Roboto:300,400,500,300italic',
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
