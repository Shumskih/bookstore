<?php

class Paginate
{
    /**
     * @var int
     */
    private int $currentPage;
    private int $countRecordsInDb;
    private int $quantityItemsOnPage;
    private int $startPosition;
    private int $countPages;

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        $this->setCurrentPage();

        return $this->currentPage;
    }


    public function setCurrentPage(): void
    {
        if (isset($_GET['page'])) $this ->currentPage = $_GET['page'];
        else  $this->currentPage = 1;
    }

    /**
     * @return int
     */
    public function getCountRecordsInDb(): int
    {
        return PaginationDaoImpl::getCountRecordsInDb();
    }

    /**
     * @param int $countRecordsInDb
     */
    public function setCountRecordsInDb(int $countRecordsInDb): void
    {
        $this->countRecordsInDb = $countRecordsInDb;
    }

    /**
     * @return int
     */
    public function getQuantityItemsOnPage(): int
    {
        $this->setQuantityItemsOnPage();

        return $this->quantityItemsOnPage;
    }

    /**
     * @param int $quantityItemsOnPage
     */
    public function setQuantityItemsOnPage(int $quantityItemsOnPage = 5): void
    {
        if (isset($_GET['countItems'])) $this->quantityItemsOnPage = $_GET['countItems'];
        else $this->quantityItemsOnPage = $quantityItemsOnPage;
    }

    /**
     * @return int
     */
    public function getStartPosition(): int
    {
        $this->setStartPosition();

        return $this->startPosition;
    }

    /**
     * @param int $startPosition
     */
    public function setStartPosition(int $startPosition = 1): void
    {
        $this->startPosition = ($this->getCurrentPage() * $this->getQuantityItemsOnPage()) - $this->getQuantityItemsOnPage();
    }

    /**
     * @return int
     */
    public function getCountPages(): int
    {
        $this->setCountPages();

        return $this->countPages;
    }

    /**
     * @param int $countPages
     */
    public function setCountPages(int $countPages = null): void
    {
        $this->countPages = ceil($this->getCountRecordsInDb() / $this->getQuantityItemsOnPage());
    }

    public function getPaginatedBooks()
    {
        $array = [];
        $books = PaginationDaoImpl::read($this->getStartPosition(), ($this->getQuantityItemsOnPage()));
        $countPages = $this->getCountPages();

        $array['books'] = $books;
        $array['countPages'] = $countPages;

        return $array;
    }
}