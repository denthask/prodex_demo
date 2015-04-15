<?php

namespace app\behaviors;

use Yii;
use \yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * преобразует дату из формата mysql в формат, необходимый для отображения
 * @param  ActiveRecord $this
 */

class DateFielder extends Behavior {

    public $updated_at;
    public $created_at;

    /**
     * вернёт дату в формате 20 Окт 2014
     * @return string
     */
    public function getDateCreatedFormatted(){
        if(isset($this->owner->created_at)) {
            return str_replace('.', '', Yii::$app->formatter->format($this->owner->created_at, ['date', 'dd LLL yyyy']));
        }
    }
    /**
     * вернёт дату в формате 20 Окт 2014
     * @return string
     */
    public function getDateEditedFormatted(){
        if(isset($this->owner->updated_at)) {
            return str_replace('.', '', Yii::$app->formatter->format($this->owner->updated_at, ['date', 'dd LLL yyyy']));
        }
    }
}