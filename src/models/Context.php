<?php

namespace lucidtaz\analytics\yii2\models;

use Yii;
use yii\db\ActiveRecord;

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
