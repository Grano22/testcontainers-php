<?php

namespace Testcontainers\Actions;

use BackedEnum;
use Closure;

final class ActionDispatcher
{
    /** @var Array<string, Closure[]> $subscribers */
    private array $subscribers = [];

    public function addSubscriber(BackedEnum $action, Closure $subscriber): self
    {
        $this->subscribers[$action->value][] = $subscriber;

        return $this;
    }

    public function dispatch(BackedEnum $action, array $arguments = []): void
    {
        foreach ($this->subscribers as $subscribedAction => $subscribers) {
            if ($subscribedAction !== '*' && $subscribedAction !== $action->value) {
                continue;
            }

            foreach ($subscribers as $subscriber) {
                $subscriber($arguments, $action);
            }
        }
    }
}