<?php

namespace Testcontainers\Actions;

use Symfony\Component\Process\Process;

class PreCommandContext implements ActionContext
{
    public function getProcess(): Process
    {

    }
}