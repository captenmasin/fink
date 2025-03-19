<?php

namespace Captenmasin\Extension\Fink\Model;

interface Publisher
{
    public function publish(Report $report): void;
}
