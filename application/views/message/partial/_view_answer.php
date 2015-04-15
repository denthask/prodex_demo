<?php
/**
 * @var $this \yii\web\View
 * @var $model app\models\Question
 */

use \yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

$dataProvider = new ArrayDataProvider([
    'allModels' => $model->answers,
]);

?>

<blockquote class="blockquote-reverse">
    <?= Html::encode($model->content) ?>
    <footer><?= $model->user->username ?> at <?= $model->dateCreatedFormatted ?></footer>
    <div class="form-group">
        <?= Html::a(
            'answer',
            ['message/view', 'id' => $model->id],
            //['class' => 'btn btn-success pull-right', /*'id' => 'answerModal',*/ 'data' => ['toggle' => 'modal', 'target' => 'answerModal', 'parent_id' => $model->id]])
            ['class' => 'btn btn-success pull-right']) ?>
    </div>
</blockquote>

<?php if($dataProvider->getCount() > 0) : ?>
    <?= ListView::widget([
            'options' => ['tag' => 'div', 'class' => 'col-lg-12'],
            'itemOptions' => ['tag' => false],
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n",
            'itemView' => '_view_answer',
    ]); ?>
<?php endif; ?>