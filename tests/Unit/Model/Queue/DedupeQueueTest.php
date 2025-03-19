<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Model\Queue;

use Captenmasin\Extension\Fink\Model\Queue\DedupeQueue;
use Captenmasin\Extension\Fink\Model\Queue\RealUrlQueue;
use Captenmasin\Extension\Fink\Model\Url;
use PHPUnit\Framework\TestCase;

class DedupeQueueTest extends TestCase
{
    public function testDoesNotSufferDuplicates()
    {
        $queue = new DedupeQueue(new RealUrlQueue());

        $queue->enqueue(Url::fromUrl('https://www.captenmasin.com'));
        $this->assertCount(1, $queue);

        $queue->enqueue(Url::fromUrl('https://www.captenmasin.com'));
        $this->assertCount(1, $queue);

        $queue->enqueue(Url::fromUrl('https://www.foobar.com'));
        $this->assertCount(2, $queue);

        $url = $queue->dequeue();
        $this->assertEquals('https://www.captenmasin.com/', $url->__toString());
    }
}
