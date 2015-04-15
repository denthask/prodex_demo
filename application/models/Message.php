<?php

namespace app\models;

use app\behaviors\DateFielder;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * Модель таблицы 'messages', исползуется как основа для моделей вопроса и ответа.
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $content
 * @property integer $is_deleted
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $dateCreatedFormatted
 * @property integer $dateEditedFormatted
 *
 * @property User $user
 * @property Answer[] $answers
 *
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            DateFielder::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'user_id', 'is_deleted', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'required'],
            ['user_id', 'default', 'value' => Yii::$app->user->id],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'is_deleted' => 'Is Deleted',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Message::className(), ['parent_id' => 'id']);
    }
}
