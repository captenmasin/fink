<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Console;

use Captenmasin\Extension\Fink\Console\Display;
use Captenmasin\Extension\Fink\Console\DisplayRegistry;
use Captenmasin\Extension\Fink\Console\Exception\DisplayNotFound;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class DisplayRegistryTest extends TestCase
{
    use ProphecyTrait;

    public function testItThrowsExceptionIfDisplayNodeFound()
    {
        $this->expectException(DisplayNotFound::class);
        $this->createRegistry()->get('foo');
    }

    public function testItReturnsRegisteredDisplays()
    {
        $expected = $this->prophesize(Display::class)->reveal();
        $display = $this->createRegistry([
            'one' => $expected
        ])->get('one');

        $this->assertSame($expected, $display);
    }

    private function createRegistry(array $displays = []): DisplayRegistry
    {
        return new DisplayRegistry($displays);
    }
}
