<?php

namespace Captenmasin\Extension\Fink\Model;

use Countable;
use IteratorAggregate;

/**
 * @extends IteratorAggregate<Report>
 */
interface ImmutableReportStore extends Countable, IteratorAggregate
{
}
