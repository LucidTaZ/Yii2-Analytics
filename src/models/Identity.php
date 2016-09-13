<?php

namespace lucidtaz\analytics\yii2\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property $id int
 * @property $user_id string
 * @property $traits string
 * @property $context_id int
 *
 * @property $traitsArray array
 * @property $context Context
 */
class Identity extends ActiveRecord
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

    public function getContext()
    {
        return $this->hasOne(Context::class, ['id' => 'context_id']);
    }
}
