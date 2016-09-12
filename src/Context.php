<?php

namespace lucidtaz\analytics\yii2;

use lucidtaz\analytics\ContextInterface;

class Context implements ContextInterface
{
    public function get(): array
    {
        return $GLOBALS;
    }
}
