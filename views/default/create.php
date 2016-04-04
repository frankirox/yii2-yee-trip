<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yeesoft\trip\models\Trip */

$this->title = Yii::t('yee/trip', 'Create Trip');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/trip', 'Trips'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="trip-create">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>