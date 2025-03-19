<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Console\Display;

use Captenmasin\Extension\Fink\Console\Display;
use Captenmasin\Extension\Fink\Console\Display\ReportListDisplay;
use Captenmasin\Extension\Fink\Model\HttpStatusCode;
use Captenmasin\Extension\Fink\Model\Report;
use Captenmasin\Extension\Fink\Model\Status;
use Captenmasin\Extension\Fink\Model\Store\CircularReportStore;
use Captenmasin\Extension\Fink\Model\Store\ImmutableReportStore;
use Captenmasin\Extension\Fink\Model\Url;
use Symfony\Component\Console\Helper\FormatterHelper;

class ReportListDisplayTest extends DisplayTestCase
{
    public function testRendersListOfReports()
    {
        $store = new CircularReportStore(5);
        $status = new Status(new ImmutableReportStore($store));
        $store->add($this->createReport(1));
        $store->add($this->createReport(2));

        $output = $this->create()->render($this->formatter, $status);
        $this->assertEquals(<<<'EOT'
[200] https://www.example1.com/
[200] https://www.example2.com/
EOT
        , FormatterHelper::removeDecoration($this->formatter, $output));
    }
    private function create(): Display
    {
        return new ReportListDisplay();
    }

    private function createReport(int $int): Report
    {
        return new Report(Url::fromUrl('https://www.example' . $int.'.com'), HttpStatusCode::fromInt(200));
    }
}
