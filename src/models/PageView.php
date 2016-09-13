<?php

namespace lucidtaz\analytics\yii2\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property $id int
 * @property $user_id string
 * @property $name string
 * @property $properties string
 * @property $context_id int
 *
 * @property $propertiesArray array
 * @property $context Context
 */
class PageView extends ActiveRecord
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

    public function setPropertiesArray(array $propertiesArray)
    {
        $this->properties = json_encode($propertiesArray);
    }

    public function getPropertiesArray()
    {
        if ($this->properties === null) {
            return null;
        }
        return json_decode($this->properties, true);
    }

    public function getContext()
    {
        return $this->hasOne(Context::class, ['id' => 'context_id']);
    }
}
