<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Model\Store;

use Captenmasin\Extension\Fink\Model\HttpStatusCode;
use Captenmasin\Extension\Fink\Model\Report;
use Captenmasin\Extension\Fink\Model\Store\CircularReportStore;
use Captenmasin\Extension\Fink\Model\Store\ImmutableReportStore;
use Captenmasin\Extension\Fink\Model\Url;
use PHPUnit\Framework\TestCase;

class ImmutableReportStoreTest extends TestCase
{
    public function testDecoratesMutableReportStore()
    {
        $store = new CircularReportStore(10);
        $store->add($this->createReport(1));
        $store->add($this->createReport(2));

        $immutable = new ImmutableReportStore($store);
        $this->assertCount(2, $immutable);
        $reports = iterator_to_array($store);
        $this->assertCount(2, $reports);
    }

    private function createReport(int $int)
    {
        return new Report(Url::fromUrl('https://www.example' . $int.'.com'), HttpStatusCode::fromInt(200));
    }
}
