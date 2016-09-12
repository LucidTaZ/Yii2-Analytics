<?php

namespace lucidtaz\analytics\yii2\models;

use Yii;
use yii\db\ActiveRecord;

/**
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
        return Yii::$app->get('dbAnalytics');
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
