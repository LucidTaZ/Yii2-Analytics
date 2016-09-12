<?php

namespace lucidtaz\analytics\yii2;

use lucidtaz\analytics\StorageInterface;
use lucidtaz\analytics\yii2\models\Association;
use lucidtaz\analytics\yii2\models\Context;
use lucidtaz\analytics\yii2\models\Event;
use lucidtaz\analytics\yii2\models\Identity;
use lucidtaz\analytics\yii2\models\PageView;

class Storage implements StorageInterface
{
    public function storeIdentify(string $userId, array $traits, array $contextValues)
    {
        $context = $this->insertContext($contextValues);

        $identity = new Identity();
        $identity->user_id = $userId;
        $identity->traitsArray = $traits;
        $identity->context_id = $context->id;
        $identity->insert();
    }

    public function storeTrack(string $userId, string $eventName, array $properties, array $contextValues)
    {
        $context = $this->insertContext($contextValues);

        $event = new Event();
        $event->user_id = $userId;
        $event->name = $eventName;
        $event->propertiesArray = $properties;
        $event->context_id = $context->id;
        $event->insert();
    }

    public function storePage(string $userId, string $pageName, array $properties, array $contextValues)
    {
        $context = $this->insertContext($contextValues);

        $pageView = new PageView();
        $pageView->user_id = $userId;
        $pageView->name = $pageName;
        $pageView->propertiesArray = $properties;
        $pageView->context_id = $context->id;
        $pageView->insert();
    }

    public function storeAssociate(string $userId1, string $userId2, string $link, array $contextValues)
    {
        $context = $this->insertContext($contextValues);

        $association = new Association();
        $association->user_id1 = $userId1;
        $association->user_id2 = $userId2;
        $association->relation = $link;
        $association->context_id = $context->id;
        $association->insert();
    }

    private function insertContext(array $contextValues)
    {
        $context = new Context();
        $context->valuesArray = $contextValues;
        $context->insert();
        return $context;
    }
}
