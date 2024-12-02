<?php

namespace Testcontainers\Container;

use BackedEnum;
use RuntimeException;
use Testcontainers\Actions\ActionDispatcher;
use Testcontainers\Actions\ActionEmitter;
use Testcontainers\Actions\DockerActions;

final class TestContainersRuntime
{
    private static TestContainersRuntime $runtime;
    private readonly ActionDispatcher $actionDispatcher;
    public readonly ActionEmitter $actions;

    private function __construct() {
        $this->actionDispatcher = new ActionDispatcher();
        $this->actions = ActionEmitter::withReagents(function (BackedEnum $action, array $arguments) {
            $this->actionDispatcher->dispatch($action, $arguments);
        });
    }
    private function __clone(): never { throw new RuntimeException("Cannot clone a singleton."); }
    public function __wakeup(): never { throw new RuntimeException("Cannot serialize a singleton."); }

    public static function deref(): TestContainersRuntime
    {
        if (!isset(self::$runtime)) {
            self::$runtime = new self();
        }

        return self::$runtime;
    }

    public function enableDebug(): TestContainersRuntime
    {
        $this->actionDispatcher->addSubscriber(DockerActions::ALL, static function (array $context, BackedEnum $action) {
            //var_dump($action, $context);
        });

        return $this;
    }
}
