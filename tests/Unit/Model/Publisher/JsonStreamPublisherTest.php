<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Model\Publisher;

use Amp\ByteStream\OutputStream;
use Amp\Loop;
use Amp\Success;
use Captenmasin\Extension\Fink\Model\Publisher;
use Captenmasin\Extension\Fink\Model\Publisher\JsonStreamPublisher;
use Captenmasin\Extension\Fink\Model\Report;
use Captenmasin\Extension\Fink\Model\ReportBuilder;
use Captenmasin\Extension\Fink\Model\Url;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class JsonStreamPublisherTest extends TestCase
{
    use ProphecyTrait;

    public const EXAMPLE_SERIALIZED_REPORT = 'serialized report';

    /**
     * @var ObjectProphecy|OutputStream
     */
    private $outputStream;

    /**
     * @var Report
     */
    private $report;

    /**
     * @var Publisher
     */
    private $publisher;

    protected function setUp(): void
    {
        $this->outputStream = $this->prophesize(OutputStream::class);
        $this->report = ReportBuilder::forUrl(Url::fromUrl('https://www.captenmasin.com'))
             ->withStatus(200)
             ->build();

        $this->publisher = new JsonStreamPublisher($this->outputStream->reveal());
    }

    public function testPublish()
    {
        $this->outputStream->write(json_encode($this->report->toArray(), true).PHP_EOL)->willReturn(new Success())->shouldBeCalledOnce();
        $this->publisher->publish($this->report);
        Loop::run();
    }
}
