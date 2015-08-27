<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Caster */

$this->title = Yii::t('app', 'Create Caster');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Casters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caster-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
