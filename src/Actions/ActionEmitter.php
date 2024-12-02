<?php

namespace Testcontainers\Actions;

use BackedEnum;
use Closure;
use StringBackedEnum;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use UnitEnum;

class ActionEmitter
{
    public static function withReagents(Closure ...$actionReagents): self
    {
        return new self($actionReagents);
    }

    private function __construct(private readonly array $actionReagents) //ActionSubscriber ...$actionSubscribers
    {
    }

    public function emit(BackedEnum $action, array $arguments = []): void
    {
        foreach ($this->actionReagents as $actionReagent) {
            $actionReagent($action, $arguments);
        }
    }

//    public function expose(): callable
//    {
//        return function /*on*/() {
//            $this->emit();
//        };
//    }
}