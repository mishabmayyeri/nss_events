<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cordinator Portal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <br>
        <br>
        <br>
        <div><?= Html::a('Create Events', ['create'], ['class' => 'btn btn-success']) ?></div>
        <br>
        <div><?= Html::a('Approve Registrations', ['site/approval'], ['class' => 'btn btn-success']) ?></div>
        <br>
        <div><?= Html::a('Review', ['site/creview'], ['class' => 'btn btn-success']) ?></div>
    </p>

<!--     <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'event_id',
            'event_name',
            'event_description:ntext',
            'venue',
            'event_date',
            //'registration_date',
            //'registration_index',
            //'coordinator_id',
            //'event_image:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
 -->

</div>
