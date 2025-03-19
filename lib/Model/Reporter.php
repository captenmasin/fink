<?php

namespace Captenmasin\Extension\Fink\Model;

use Amp\Http\Client\Response;

interface Reporter
{
    public function logResponse(Response $response): void;
}
