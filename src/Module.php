<?php

namespace lucidtaz\analytics\yii2;

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
        // TODO: Set event handlers etc.
        \Yii::info('Bootstrapping!', __METHOD__);
    }
}
