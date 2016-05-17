<?php

use yeesoft\grid\GridPageSize;
use yeesoft\grid\GridView;
use yeesoft\helpers\Html;
use yeesoft\models\User;
use yeesoft\trip\models\Trip;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel yeesoft\trip\models\TripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('yee/trip', 'Trips');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trip-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('yee', 'Add New'), ['/trip/default/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php
                    /* Uncomment this to activate GridQuickLinks */
                    /* echo GridQuickLinks::widget([
                      'model' => Trip::className(),
                      'searchModel' => $searchModel,
                      ]) */
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'trip-grid-pjax']) ?>
                </div>
            </div>

            <?php
            Pjax::begin([
                'id' => 'trip-grid-pjax',
            ])
            ?>

            <?=
            GridView::widget([
                'id' => 'trip-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'trip-grid',
                    'actions' => [Url::to(['bulk-delete']) => Yii::t('yee', 'Delete')] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'attribute' => 'vehicle_model',
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => '/trip/default',
                        'title' => function (Trip $model) {
                            $vehicle = $model->getVehicles()[$model->vehicle] . ' > ' . $model->vehicle_model;
                            return Html::a($vehicle, ['update', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                        'buttonsTemplate' => '{update} {delete}',
                        'options' => ['style' => 'width:260px'],
                    ],


                    'city_from',
                    'city_to',
                    [
                        'attribute' => 'created_by',
                        'filter' => User::getUsersList(),
                        'value' => function (Trip $model) {
                            return Html::a($model->author->username,
                                ['/user/default/update', 'id' => $model->created_by],
                                ['data-pjax' => 0]);
                        },
                        'format' => 'raw',
                        'visible' => User::hasPermission('viewUsers'),
                    ],
                    [
                        'class' => 'yeesoft\grid\columns\StatusColumn',
                        'attribute' => 'type',
                        'optionsArray' => Trip::getTypeOptionsList(),
                        'options' => ['style' => 'width:60px'],
                    ],
                    [
                        'class' => 'yeesoft\grid\columns\StatusColumn',
                        'attribute' => 'status',
                        'optionsArray' => Trip::getStatusOptionsList(),
                        'options' => ['style' => 'width:60px'],
                    ],
                    // 'date',
                    // 'schedule:ntext',
                    // 'price:ntext',
                    // 'vehicle',
                    // 'vehicle_model',
                    // 'wifi',
                    // 'fridge',
                    // 'conditioner',
                    // 'contacts:ntext',
                    // 'luggage',
                    // 'status',
                    // 'created_by',
                    // 'updated_by',
                    // 'created_at',
                    // 'updated_at',
                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


