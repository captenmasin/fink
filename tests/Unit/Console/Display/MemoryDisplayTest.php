<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Console\Display;

use Captenmasin\Extension\Fink\Console\Display\MemoryDisplay;
use Captenmasin\Extension\Fink\Model\Status;
use Symfony\Component\Console\Helper\FormatterHelper;

class MemoryDisplayTest extends DisplayTestCase
{
    public function testShowsMemoryUsage()
    {
        $display = new MemoryDisplay();
        $output = $display->render($this->formatter, new Status());

        $this->assertStringContainsString(<<<'EOT'
Memory
EOT
        , FormatterHelper::removeDecoration($this->formatter, $output));
    }
}
