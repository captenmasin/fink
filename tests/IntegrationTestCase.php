<?php

namespace Captenmasin\Extension\Fink\Tests;

use Amp\PHPUnit\AsyncTestCase;
use Phpactor\TestUtils\Workspace;

class IntegrationTestCase extends AsyncTestCase
{
    /**
     * @var Workspace
     */
    private $workspace;

    protected function setUp(): void
    {
        parent::setUp();

        $this->workspace = Workspace::create(__DIR__ . '/Workspace');
        $this->workspace->reset();
    }

    protected function workspace(): Workspace
    {
        return $this->workspace;
    }
}
