<?php

namespace Testcontainers\Actions;

interface ActionSubscriber /* Tracker */
{
    public function subscribe(): void;
}
