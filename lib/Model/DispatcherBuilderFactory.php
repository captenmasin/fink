<?php

namespace Captenmasin\Extension\Fink\Model;

use Captenmasin\Extension\Fink\DispatcherBuilder;

class DispatcherBuilderFactory
{
    public function createForUrls($urls): DispatcherBuilder
    {
        return DispatcherBuilder::create($urls);
    }
}
