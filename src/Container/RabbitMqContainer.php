<?php

declare(strict_types=1);

namespace Testcontainers\Container;

use Testcontainers\Wait\WaitForExec;

class RabbitMqContainer extends Container
{
    public function __construct(string $version)
    {
        parent::__construct('rabbitmq:' . $version);
        $this->withWait(new WaitForExec(["rabbitmqctl", "status"]));
    }

    public static function make(string $version): self
    {
        return new self($version);
    }

    public function withRabbitMQUser(string $username, string $password): self
    {
        $this->withEnvironment('RABBITMQ_DEFAULT_USER', $username);
        $this->withEnvironment('RABBITMQ_DEFAULT_PASS', $password);

        return $this;
    }

    public function withRabbitMQVhost(string $defaultVhost): self
    {
        $this->withEnvironment('RABBITMQ_DEFAULT_VHOST', $defaultVhost);

        return $this;
    }
}
