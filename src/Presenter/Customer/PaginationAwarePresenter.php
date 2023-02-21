<?php

namespace CFM\Presenter\Customer;

use CFM\Presenter\AbstractPresenter;

final class PaginationAwarePresenter extends AbstractPresenter
{

    /**
     * @param array<int, AbstractPresenter> $current
     * @param string|null $next
     * @param string|null $previous
     */
    public function __construct(
        private readonly array   $current,
        private readonly int     $currentPage,
        private readonly int     $pageCount,
        private readonly int     $total,
        private readonly string  $last,
        private readonly ?string $next,
        private readonly ?string $previous,
    )
    {
    }

    public function present(): array
    {
        return [
            'current' => array_map(function (AbstractPresenter $content) {
                return $content->present();
            }, $this->current),
            'current_page' => $this->currentPage,
            'next' => $this->next,
            'previous' => $this->previous,
            'total' => $this->total,
            'page_count' => $this->pageCount,
            'last' => $this->last,
        ];
    }
}