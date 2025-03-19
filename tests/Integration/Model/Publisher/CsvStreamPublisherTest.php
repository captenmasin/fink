<?php

namespace Captenmasin\Extension\Fink\Tests\Integration\Model\Publisher;

use Captenmasin\Extension\Fink\Model\Publisher;
use Captenmasin\Extension\Fink\Model\ReportBuilder;
use Captenmasin\Extension\Fink\Model\Publisher\CsvStreamPublisher;
use Captenmasin\Extension\Fink\Model\Url;
use Captenmasin\Extension\Fink\Tests\IntegrationTestCase;
use DateTimeImmutable;

class CsvStreamPublisherTest extends IntegrationTestCase
{
    public const EXAMPLE_FILEANME = 'test';

    public function testPublishesToCsvFile()
    {
        $report = ReportBuilder::forUrl(Url::fromUrl('https://www.captenmasin.com'))
            ->withTimestamp(new DateTimeImmutable('2019-01-01 00:00:00 +00:00'))
            ->withStatus(200)
            ->build();

        $serialized = $this->create()->publish($report);
        $this->assertEquals(<<<'EOT'
0,,,,,0,200,,https://www.captenmasin.com/,2019-01-01T00:00:00+00:00

EOT
        , file_get_contents($this->workspace()->path(self::EXAMPLE_FILEANME)));
    }

    public function testPublishesToCsvFileWithHeaders()
    {
        $report = ReportBuilder::forUrl(Url::fromUrl('https://www.captenmasin.com'))
            ->withTimestamp(new DateTimeImmutable('2019-01-01 00:00:00 +00:00'))
            ->withStatus(200)
            ->build();

        $serialized = $this->create(true)->publish($report);
        $this->assertStringContainsString(<<<'EOT'
distance,exception,referrer,referrer_title,referrer_xpath,request_time,status,http_version,url,timestamp
0,,,,,0,200,,https://www.captenmasin.com/,2019-01-01T00:00:00+00:00

EOT
        , file_get_contents($this->workspace()->path(self::EXAMPLE_FILEANME)));
    }

    private function create(bool $withHeaders = false): Publisher
    {
        $resource = fopen($this->workspace()->path(self::EXAMPLE_FILEANME), 'w');
        return new CsvStreamPublisher($resource, $withHeaders);
    }
}
