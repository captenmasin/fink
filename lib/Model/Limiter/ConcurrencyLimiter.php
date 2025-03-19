<?php

namespace Captenmasin\Extension\Fink\Model\Limiter;

use Captenmasin\Extension\Fink\Model\Limiter;
use Captenmasin\Extension\Fink\Model\Status;

class ConcurrencyLimiter implements Limiter
{
    /**
     * @var int
     */
    private $maxConcurrency;

    public function __construct(int $maxConcurrency)
    {
        $this->maxConcurrency = $maxConcurrency;
    }

    public function limitReached(Status $status): bool
    {
        return $status->nbConcurrentRequests >= $this->maxConcurrency;
    }
}
