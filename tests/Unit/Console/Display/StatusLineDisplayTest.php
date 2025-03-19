<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Console\Display;

use Captenmasin\Extension\Fink\Console\Display;
use Captenmasin\Extension\Fink\Console\Display\StatusLineDisplay;
use Captenmasin\Extension\Fink\Model\Status;
use Symfony\Component\Console\Helper\FormatterHelper;

class StatusLineDisplayTest extends DisplayTestCase
{
    public function testRendersStatusLine()
    {
        $display = $this->create();
        $output = $display->render($this->formatter, new Status());

        $this->assertEquals(<<<'EOT'
----------------------------------------------------
Concurrency: 0, Queue size: 0, Failures: 0/0 (0.00%)
EOT
        , FormatterHelper::removeDecoration($this->formatter, $output));
    }

    private function create(): Display
    {
        return new StatusLineDisplay();
    }
}
