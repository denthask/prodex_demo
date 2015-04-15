<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="message-index">

    <div class="row">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create new Question', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= ListView::widget([
            'options' => ['tag' => 'div'],
            'itemOptions' => ['tag' => 'div', 'class' => 'col-lg-6'],
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}\n",
            'itemView' => 'partial/_view_question',
        ]) ?>
    </div>
</div>
