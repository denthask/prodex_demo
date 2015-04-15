<?php
/**
 * @var $model app\models\Question
 */

use \yii\helpers\Html;

?>
<blockquote>
    <span><b>Author: </b><?= $model->user->username ?></span>
    <span class="pull-right" ><b>Created: </b><?= $model->dateCreatedFormatted ?></span>
    <p><b>Message: </b><?= Html::encode($model->content) ?></p>
    <div class="form-group">
        <?= Html::a('view answers', ['message/view', 'id' => $model->id], ['class' => 'btn btn-info pull-right']) ?>
    </div>
</blockquote>

