<?php


class PaginationController
{
    private Paginate $paginate;

    public function __construct()
    {
        $this->paginate = new Paginate();
    }

    public function getCountRecordsInDb(): int
    {
        return $this->paginate->getCountRecordsInDb();
    }
}