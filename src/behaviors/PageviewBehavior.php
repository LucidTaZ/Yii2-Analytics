<?php

namespace lucidtaz\analytics\yii2\behaviors;

use lucidtaz\analytics\Analytics;
use Yii;
use yii\base\ActionEvent;
use yii\base\Behavior;
use yii\base\Controller;
use yii\web\Request;

class PageviewBehavior extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    public function beforeAction(ActionEvent $event)
    {
        /* @var $analytics Analytics */
        $analytics = Yii::$app->get('analytics');

        /* @var $request Request */
        $request = Yii::$app->request;

        if (Yii::$app->user->isGuest) {
            if (Yii::$app->session->isActive) {
                $userId = 'guest_session_' . Yii::$app->session->id;
            } else {
                $userId = 'guest_ip_' . $request->userIP;
            }
        } else {
            $userId = 'user_id_' . Yii::$app->user->identity->getId();
        }

        $pageName = $request->url;

        $properties = [
            'action' => $event->action->uniqueId,
        ];

        $analytics->page($userId, $pageName, $properties);
    }
}
