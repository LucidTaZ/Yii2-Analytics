<?php

namespace lucidtaz\analytics\yii2\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property $id int
 * @property $user_id1 string
 * @property $user_id2 string
 * @property $relation string
 * @property $context_id int
 */
class Association extends ActiveRecord
{
    public function getDb()
    {
        return Yii::$app->get('dbAnalytics');
    }
}
