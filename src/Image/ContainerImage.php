<?php

namespace Testcontainers\Image;

use Stringable;
use Symfony\Component\Process\Process;

class ContainerImage implements Stringable
{
    public const LATEST = 'latest';

    public static function as(string $name, string $version, ?string $repo = null): self
    {
        return new self($name, $version, $repo ?? '');
    }

    private function __construct(
        public readonly string $name,
        public readonly string $tag,
        public readonly string $repo
    ) {
    }

    public function withName(string $name): self
    {
        return new self($name, $this->tag, $this->repo);
    }

    public function getAsFullName(): string
    {
        return ($this->repo ? ($this->repo . '/') : '') . $this->name . ':' . $this->tag;
    }

    public function exists(): bool
    {
        $dockerImageCommand = new Process(['docker', 'inspect', '--type=image', $this->getAsFullName()]);

        $dockerImageCommand->run();

        return $dockerImageCommand->isSuccessful();
    }

    public function __toString(): string
    {
        return $this->getAsFullName();
    }
}