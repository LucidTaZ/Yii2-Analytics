<?php

namespace lucidtaz\analytics\yii2;

use lucidtaz\analytics\Analytics;
use lucidtaz\analytics\yii2\models\Identity;
use Yii;
use yii\base\BootstrapInterface;
use yii\db\Connection;
use yii\di\Instance;
use yii\web\User;
use yii\web\UserEvent;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $db = 'db';

    public $registerAssociationOnLogin = true;
    public $registerAssociationOnLogout = true;

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

        if ($this->registerAssociationOnLogin) {
            $app->user->on(User::EVENT_AFTER_LOGIN, [$this, 'afterLogin']);
        }
        if ($this->registerAssociationOnLogout) {
            $app->user->on(User::EVENT_BEFORE_LOGOUT, [$this, 'beforeLogout']);
        }

        Yii::trace('Finished bootstrap.', __METHOD__);
    }

    public function afterLogin(UserEvent $event)
    {
        Yii::trace('Making login association...', __METHOD__);
        // TODO: Fix problem where Yii juggles the session ID, giving an unreliable generated user ID. Use something else?

        /* @var $analytics Analytics */
        $analytics = Yii::$app->get('analytics');
        $previousUserId = Identity::generateUserIdForGuest();
        $newUserId = Identity::generateUserId();
        $analytics->associate($previousUserId, $newUserId, 'login');
    }

    public function beforeLogout(UserEvent $event)
    {
        Yii::trace('Making logout association...', __METHOD__);
        // TODO: Fix problem where Yii renews the session ID, giving an unreliable generated user ID. Use something else?

        /* @var $analytics Analytics */
        $analytics = Yii::$app->get('analytics');
        $previousUserId = Identity::generateUserId();
        $newUserId = Identity::generateUserIdForGuest();
        $analytics->associate($previousUserId, $newUserId, 'logout');
    }
}
