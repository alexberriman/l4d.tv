<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;
use backend\themes\remark\assets\ThemeAsset;
use backend\themes\remark\assets\LoginAsset;

AppAsset::register($this);
ThemeAsset::register($this);
LoginAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html class="no-js css-menubar" lang="<?= Yii::$app->language ?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="page-login-v2 layout-full page-dark">
    <?php $this->beginBody() ?>

    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
        href="http://browsehappy.com/">upgrade
        your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Page -->
    <div class="page animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content">
            <div class="page-brand-info">
                <div class="brand">
                    <div class="login-logo"></div>

                    <h2 class="brand-text font-size-40">
                        <?= Html::encode(Yii::$app->params['siteName']) ?>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <p class="font-size-20">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="page-login-main">
                <?= Alert::widget() ?>
                <?= $content ?>

                <footer class="page-copyright">
                    <p>&copy; <?= date('Y') ?> <a href="https://l4d.tv/">l4d.tv</a>.<br>All Rights Reserved.</p>
                </footer>
            </div>

        </div>
    </div>
    <!-- End Page -->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>