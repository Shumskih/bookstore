<?php

class Paginate
{
    private int $currentPage;
    private int $countRecordsInDb;
    private int $quantityItemsOnPage;
    private int $startPosition;
    private int $showQuantityRecordsOnPage;

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
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
        return $this->quantityItemsOnPage;
    }

    /**
     * @param int $quantityItemsOnPage
     */
    public function setQuantityItemsOnPage(int $quantityItemsOnPage): void
    {
        $this->quantityItemsOnPage = $quantityItemsOnPage;
    }

    /**
     * @return int
     */
    public function getStartPosition(): int
    {
        return $this->startPosition;
    }

    /**
     * @param int $startPosition
     */
    public function setStartPosition(int $startPosition): void
    {
        $this->startPosition = $startPosition;
    }

    /**
     * @return int
     */
    public function getShowQuantityRecordsOnPage(): int
    {
        return $this->showQuantityRecordsOnPage;
    }

    /**
     * @param int $showQuantityRecordsOnPage
     */
    public function setShowQuantityRecordsOnPage(int $showQuantityRecordsOnPage): void
    {
        $this->showQuantityRecordsOnPage = $showQuantityRecordsOnPage;
    }
}