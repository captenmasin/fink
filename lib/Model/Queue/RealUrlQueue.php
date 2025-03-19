<?php

namespace Captenmasin\Extension\Fink\Model\Queue;

use Captenmasin\Extension\Fink\Model\Url;
use Captenmasin\Extension\Fink\Model\UrlQueue as UrlQueueInterface;

final class RealUrlQueue implements UrlQueueInterface
{
    private $urls = [];

    public function enqueue(Url $url): void
    {
        $this->urls[] = $url;
    }

    public function dequeue(): ?Url
    {
        return \array_shift($this->urls);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->urls);
    }
}
