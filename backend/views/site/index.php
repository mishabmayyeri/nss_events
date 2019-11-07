<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
 

$this->title = 'NSS EVENT';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>NSS Events</h1>
    </div>

    <div class="body-content">
           <?php
           		
           		echo ListView::widget([
    			'dataProvider' => $events,
    			'itemView' => '_post',
				]);
           ?>
                   
            
        </div>

    </div>
</div>
