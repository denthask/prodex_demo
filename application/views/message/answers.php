<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

/* @var $model \app\models\Question */
/* @var $newAnswerModel \app\models\Answer */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <div class="row">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="col-lg-12">

            <blockquote>
                <span><b>Author: </b><?= $model->user->username ?></span>
                <span class="pull-right" ><b>Created: </b><?= $model->dateCreatedFormatted ?></span>
                <p>
                    <b>Message: </b><?= Html::encode($model->content) ?>
                </p>
            </blockquote>

            <?php if(!Yii::$app->user->isGuest): ?>
                <?= $this->render('_form', ['model' => $newAnswerModel]) ?>
            <?php endif; ?>

        </div>

        <h1>Answers</h1>
        <?= ListView::widget([
            'options' => ['tag' => 'div'],
            'itemOptions' => ['tag' => 'div', 'class' => 'col-lg-12'],
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}\n",
            'itemView' => 'partial/_view_answer',
        ]) ?>

    </div>
</div>
