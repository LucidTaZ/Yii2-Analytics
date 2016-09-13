<?php

namespace lucidtaz\analytics\yii2;

use lucidtaz\analytics\Analytics;
use Yii;
use yii\base\BootstrapInterface;
use yii\db\Connection;
use yii\di\Instance;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $db = 'db';

    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
    }

    public function bootstrap($app)
    {
        Yii::trace('Starting bootstrap.', __METHOD__);

        $analytics = new Analytics();
        $analytics->setContext(new Context());
        $analytics->setStorage(new Storage());
        $app->set('analytics', $analytics);
        Yii::trace('Set ' . get_class($analytics) . ' as $app->analytics.', __METHOD__);

        Yii::trace('Finished bootstrap.', __METHOD__);
    }
}
