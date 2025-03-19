<?php

namespace Captenmasin\Extension\Fink\Model\Store;

use ArrayIterator;
use Captenmasin\Extension\Fink\Model\Report;
use Captenmasin\Extension\Fink\Model\ReportStore;
use Iterator;

final class CircularReportStore implements ReportStore
{
    /**
     * @var Report[]
     */
    private $reports = [];

    /**
     * @var int
     */
    private $size;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function add(Report $report): void
    {
        if (count($this->reports) >= $this->size) {
            array_shift($this->reports);
        }

        $this->reports[] = $report;
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->reports);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->reports);
    }
}
