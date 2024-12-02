<?php

declare(strict_types=1);

namespace Testcontainers\Actions;
// UnitEnum vs BackedEnum
enum DockerActions: string
{
    case ALL = '*';
    case PREPARE_DOCKER_RUN_COMMAND = 'command.docker.prepare';
    case FETCHED_CONTAINER_DETAILS = 'container.details.fetched';
}
