<?php

namespace app\models;

/**
 * Определяет модель ответ на базе модели Message.
 *
 * Определение выполняется по следующему принципу:
 * все сообщения, у которых значение parent_id != null - являются ответами на вопросы
 * возможно создавать ответ для ответа на вопрос (ответы на ответы).
 *
 */
class Answer extends Message
{
    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->andWhere('parent_id IS NOT NULL');
    }

    /**
     * для ответа всегда необходимо указывать идентификатор вопроса для которого создаётся ответ.
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['parent_id'], 'required'];
        return $rules;
    }
}
