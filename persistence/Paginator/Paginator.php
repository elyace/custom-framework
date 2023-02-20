<?php

namespace Persistence\Paginator;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

trait Paginator
{
    public function paginate(QueryBuilder $query, int $page = 1, int $pageSize = 10): DoctrinePaginator
    {
        // load doctrine Paginator
        $paginator = new DoctrinePaginator($query);

        // you can get total items
        $totalItems = count($paginator);

        // get total pages
        $pagesCount = ceil($totalItems / $pageSize);

        // now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($page-1)) // set the offset
            ->setMaxResults($pageSize); // set the limit

        return $paginator;
    }
}