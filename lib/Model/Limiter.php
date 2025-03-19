<?php

namespace Captenmasin\Extension\Fink\Model;

interface Limiter
{
    public function limitReached(Status $status): bool;
}
