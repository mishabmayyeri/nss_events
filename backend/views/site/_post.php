<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;


?>

<div class="post">
    <h2><?= Html::encode($model->event_name) ?></h2><br>
 Event Description::   <?= HtmlPurifier::process($model->event_description) ?>  <br>  
 Venue::   <?= HtmlPurifier::process($model->venue) ?>     <br>
 Event Date::   <?= HtmlPurifier::process($model->event_date) ?>     <br>
 Registration Date::   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
 <button> Register to <?= HtmlPurifier::process($model->event_name) ?> ? </button>
</div>