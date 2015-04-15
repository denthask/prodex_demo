<?php

namespace app\models;

/**
 * Определяет модель вопросам на базе модели Message.
 *
 * Определение выполняется по следующему принципу:
 * все сообщения, у которых значение parent_id == null - являются вопросами
 * у одного вопроса может быть множество ответов
 *
 */
class Question extends Message
{
    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->andWhere('parent_id IS NULL');
    }
}
