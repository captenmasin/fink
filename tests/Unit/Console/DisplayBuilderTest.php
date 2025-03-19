<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Console;

use Captenmasin\Extension\Fink\Console\Display;
use Captenmasin\Extension\Fink\Console\DisplayBuilder;
use Captenmasin\Extension\Fink\Console\DisplayRegistry;
use Captenmasin\Extension\Fink\Console\Display\ConcatenatingDisplay;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class DisplayBuilderTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ObjectProphecy
     */
    private $registry;
    /**
     * @var ObjectProphecy
     */
    private $display1;
    /**
     * @var ObjectProphecy
     */
    private $display2;

    /**
     * @var DisplayBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->registry = $this->prophesize(DisplayRegistry::class);
        $this->display1 = $this->prophesize(Display::class);
        $this->display2 = $this->prophesize(Display::class);
    }

    public function testSetsADisplay()
    {
        $this->registry->get('foo')->willReturn($this->display1->reveal());

        $display = $this->createBuilder(['bar'])->build('foo');
        $this->assertEquals(new ConcatenatingDisplay([
            $this->display1->reveal()
        ]), $display);
    }

    public function testConcatenatesMultipleDisplays()
    {
        $this->registry->get('foo')->willReturn($this->display1->reveal());
        $this->registry->get('bar')->willReturn($this->display2->reveal());

        $display = $this->createBuilder()->build('foo');
        $this->assertEquals(new ConcatenatingDisplay([
            $this->display1->reveal()
        ]), $display);
    }

    public function testAddsDisplayWithPlusPrefix()
    {
        $this->registry->get('foo')->willReturn($this->display1->reveal());
        $this->registry->get('bar')->willReturn($this->display2->reveal());

        $display = $this->createBuilder(['foo'])->build('+bar');
        $this->assertEquals(new ConcatenatingDisplay([
            $this->display1->reveal(),
            $this->display2->reveal()
        ]), $display);
    }

    public function testRemovesADisplayWithAMinusPrefix()
    {
        $this->registry->get('foo')->willReturn($this->display1->reveal());
        $this->registry->get('bar')->willReturn($this->display2->reveal());

        $display = $this->createBuilder(['foo', 'bar'])->build('-bar');
        $this->assertEquals(new ConcatenatingDisplay([
            $this->display1->reveal()
        ]), $display);
    }

    private function createBuilder(array $defaults = []): DisplayBuilder
    {
        return new DisplayBuilder($this->registry->reveal(), $defaults);
    }
}
