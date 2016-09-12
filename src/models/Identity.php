<?php

namespace lucidtaz\analytics\yii2\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property $id int
 * @property $user_id string
 * @property $traits string
 * @property $context_id int
 *
 * @property $traitsArray array
 */
class Identity extends ActiveRecord
{
    public function getDb()
    {
        return Yii::$app->get('dbAnalytics');
    }

    public function setTraitsArray(array $traitsArray)
    {
        $this->traits = json_encode($traitsArray);
    }

    public function getTraitsArray()
    {
        if ($this->traits === null) {
            return null;
        }
        return json_decode($this->traits, true);
    }
}
