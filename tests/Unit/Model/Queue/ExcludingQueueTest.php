<?php

namespace Captenmasin\Extension\Fink\Tests\Unit\Model\Queue;

use Captenmasin\Extension\Fink\Model\Queue\ExcludingQueue;
use Captenmasin\Extension\Fink\Model\Queue\RealUrlQueue;
use Captenmasin\Extension\Fink\Model\Url;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ExcludingQueueTest extends TestCase
{
    public function testPassesThroughWithNoExcludes()
    {
        $queue = new ExcludingQueue(new RealUrlQueue(), []);

        $url = Url::fromUrl('https://www.foobar.com');
        $queue->enqueue($url);
        Assert::assertCount(1, $queue);
    }

    public function testFiltersUrl()
    {
        $queue = new ExcludingQueue(new RealUrlQueue(), [
            'foobar'
        ]);

        $url1 = Url::fromUrl('https://www.barfoo.com');
        $url2 = Url::fromUrl('https://www.foobar.com');
        $queue->enqueue($url1);
        $queue->enqueue($url2);
        Assert::assertCount(1, $queue);
    }
}
