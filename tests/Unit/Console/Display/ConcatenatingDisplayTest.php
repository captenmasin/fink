<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Console\Display;

use Captenmasin\Extension\Fink\Console\Display;
use Captenmasin\Extension\Fink\Console\Display\ConcatenatingDisplay;
use Captenmasin\Extension\Fink\Model\Status;
use Prophecy\PhpUnit\ProphecyTrait;

class ConcatenatingDisplayTest extends DisplayTestCase
{
    use ProphecyTrait;

    /**
     * @var ObjectProphecy|Display
     */
    private $display1;

    /**
     * @var ObjectProphecy|Display
     */
    private $display2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->display1 = $this->prophesize(Display::class);
        $this->display2 = $this->prophesize(Display::class);
    }

    public function testReturnsEmptyStringWithNoDisplays()
    {
        $display = $this->create([]);
        $output = $display->render($this->formatter, new Status());
        $this->assertEquals('', $output);
    }

    public function testConcatenatesTheOutputOfOtherDisplays()
    {
        $status = new Status();
        $this->display1->render($this->formatter, $status)->willReturn('foo');
        $this->display2->render($this->formatter, $status)->willReturn('bar');

        $display = $this->create([
            $this->display1->reveal(),
            $this->display2->reveal(),
        ]);
        $output = $display->render($this->formatter, $status);
        $this->assertEquals(<<<'EOT'
foo
bar
EOT
, $output);
    }

    private function create(array $array): Display
    {
        return new ConcatenatingDisplay($array);
    }
}
