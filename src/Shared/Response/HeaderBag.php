<?php

namespace CFM\Shared\Response;

trait HeaderBag
{

    private array $headers = [];

    public function addHeader(string $key, string $value): self
    {

        $this->headers[$key] = $value;

        return $this;
    }

    public function setCacheAge(int $second): self
    {

        return $this->addHeader('Cache-Control', sprintf('max-age=%s', $second));
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}