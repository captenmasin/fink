<?php

namespace Captenmasin\Extension\Fink\Console;

use Captenmasin\Extension\Fink\Model\Status;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;

interface Display
{
    public function render(OutputFormatterInterface $output, Status $status): string;
}
