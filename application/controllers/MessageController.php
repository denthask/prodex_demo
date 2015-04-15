<?php

namespace app\controllers;

use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Message;
use app\models\Question;
use app\models\Answer;

/**
 * Выполняет CRUD функции с моделями Answer && Question.
 *
 * Доступ для создание вопроса и ответа на вопрос разрешён только зарегистрированным пользователям
 */
class MessageController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['create', 'answer'],
                'only' => ['create'],
                'rules' => [
                    [
                        //'actions' => ['create', 'answer'],
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Question::find(),
        ]);

        return $this->render('questions', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Отобразит выбранный вопрос и все ответы на него (включая ответы на ответы).
     *
     * Если указанного вопроса не существует будет выброшено исключение.
     * Если указанный вопрос существует будет выполнено:
     * - начальное наполнения модели для создания ответа на вопрос
     * - сохранение нового ответа в случае если выполняется передача данных и валидация пройдена успешно
     * Если передача данных не выполняется или не пройдена валидация - отобразит найденный вопрос
     * Перенаправит на страницу просмотра текущего вопроса со всеми ответами (включая ответы на ответы) и формой для создания ответа на вопрос.
     *
     * @param integer $id идентификатор вопроса
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $newAnswerModel = new Answer();

        $newAnswerModel->parent_id = $model->id;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $model->answers,
        ]);

        if($newAnswerModel->load(Yii::$app->request->post()) && $newAnswerModel->save()) {
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('answers', [
                'model' => $model,
                'newAnswerModel' => $newAnswerModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * Создаст новый вопрос (стандартный метод CRUD)
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Question();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /*public function actionAnswer($parent_id)
    {
        $parentModel = $this->findModel($parent_id);

        $model = new Answer();

        $model->parent_id = $parentModel->id;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $parentModel->answers,
        ]);

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['answers', 'parent_id' => $parent_id]);
        } else {
            return $this->render('answers', [
                'model' => $model,
                'parentModel' => $parentModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }*/

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
