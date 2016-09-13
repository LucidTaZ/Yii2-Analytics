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
 *
 * @property $context Context
 */
class Association extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->getModule('analytics')->db;
    }

    public function getContext()
    {
        return $this->hasOne(Context::class, ['id' => 'context_id']);
    }
}
