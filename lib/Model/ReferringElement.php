<?php

namespace Captenmasin\Extension\Fink\Model;

use DOMNode;

class ReferringElement
{
    private $xpath = '';
    private $title = '';
    private $baseUri = '';

    public static function none(): ReferringElement
    {
        return new self();
    }

    public static function fromDOMNode(DOMNode $element): ReferringElement
    {
        $new = new self();
        $new->xpath = $element->getNodePath();
        $new->title = trim($element->nodeValue);
        $new->baseUri = $element->baseURI;

        return $new;
    }

    public function baseUri(): ?string
    {
        return $this->baseUri;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function path(): string
    {
        return $this->xpath;
    }
}
