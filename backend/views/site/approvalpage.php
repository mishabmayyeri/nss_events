<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
 

$this->title = 'NSS EVENT';
?>
<div class="site-reviewpage">

    <div class="jumbotron">
        <h1>NSS Events</h1>
    </div>

    <div class="body-content">
           <?php
           		echo ListView::widget([
                'dataProvider' => $reviews,
                'itemView' => 'review_post',
                ]);
           		
           ?>
                   
            
        </div>

    </div>
</div>