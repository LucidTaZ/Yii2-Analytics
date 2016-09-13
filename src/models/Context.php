<?php

namespace lucidtaz\analytics\yii2\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property $id int
 * @property $values string
 *
 * @property $valuesArray array
 */
class Context extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->getModule('analytics')->db;
    }

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function setValuesArray(array $valuesArray)
    {
        $this->values = json_encode($valuesArray);
    }

    public function getValuesArray()
    {
        if ($this->values === null) {
            return null;
        }
        return json_decode($this->values, true);
    }
}
