<?php

namespace Captenmasin\Extension\Fink\Model\Store;

use Captenmasin\Extension\Fink\Model\ImmutableReportStore as ImmutableReportStoreInterface;
use Captenmasin\Extension\Fink\Model\ReportStore;
use Traversable;

class ImmutableReportStore implements ImmutableReportStoreInterface
{
    /**
     * @var ReportStore
     */
    private $innerStore;

    public function __construct(ReportStore $innerStore)
    {
        $this->innerStore = $innerStore;
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return $this->innerStore->count();
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): Traversable
    {
        return $this->innerStore->getIterator();
    }
}
