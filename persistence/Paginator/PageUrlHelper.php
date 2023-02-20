<?php

namespace Persistence\Paginator;

trait PageUrlHelper
{

    private int $currentPage;
    private int $pageCount;
    private string $route;

    public function getNextPageUrl(): ?string
    {
        $nextPage = $this->currentPage + 1;
        $nextPage = $nextPage >= $this->pageCount ? null : $nextPage;

        return null === $nextPage ? null : sprintf('%s%s?page=%s', env('APP_HOST'), $this->route, $nextPage);
    }

    public function getPrevPageUrl(): ?string
    {
        $prevPage = $this->currentPage - 1;
        $prevPage = $prevPage > 0 ? $prevPage : null;

        return null === $prevPage ? null : sprintf('%s%s?page=%s', env('APP_HOST'), $this->route, $prevPage);
    }

    public function getLastPageUrl(): string
    {
        return sprintf('%s%s?page=%s', env('APP_HOST'), $this->route, $this->pageCount);
    }

    public function setPageCount(int $pageCount): self
    {
        $this->pageCount = $pageCount;

        return $this;
    }

    public function setCurrentPage(int $currentPage): self
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }
}