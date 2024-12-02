<?php

declare(strict_types=1);

namespace Testcontainers\Container;

use Testcontainers\Image\ContainerImage;
use Testcontainers\Wait\WaitForExec;

class PostgresContainer extends Container
{
    public static function defaultImage(): ContainerImage
    {
        return parent::defaultImage()->withName('postgres');
    }

    private function __construct(string $rootPassword, ?ContainerImage $customImage = null)
    {
        parent::__construct(($customImage ?? self::defaultImage())->getAsFullName());
        $this->withEnvironment('POSTGRES_PASSWORD', $rootPassword);
        $this->withWait(new WaitForExec(["pg_isready", "-h", "127.0.0.1"]));
    }

    public static function make(string $rootPassword = 'root', ?ContainerImage $customImage = null): self
    {
        return new self($rootPassword, $customImage);
    }

    public function withPostgresUser(string $username): self
    {
        $this->withEnvironment('POSTGRES_USER', $username);

        return $this;
    }

    public function withPostgresDatabase(string $database): self
    {
        $this->withEnvironment('POSTGRES_DB', $database);

        return $this;
    }
}
