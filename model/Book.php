<?php


class Book
{

  private $title;

  private $authorName;

  private $authorSurname;

  private $pages;

  private $description;

  private $categories = array();

  /**
   * Book constructor.
   *
   * @param $title
   * @param $authorName
   * @param $authorSurname
   * @param $pages
   * @param $description
   */
  public function __construct(
    $title,
    $authorName,
    $authorSurname,
    $description,
    $pages
  ) {
    $this->title         = $title;
    $this->authorName    = $authorName;
    $this->authorSurname = $authorSurname;
    $this->pages         = $pages;
    $this->description   = $description;
  }


  /**
   * @return mixed
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @param mixed $title
   */
  public function setTitle($title): void
  {
    $this->title = $title;
  }

  /**
   * @return int
   */
  public function getPages()
  {
    return $this->pages;
  }

  /**
   * @param int $pages
   */
  public function setPages(int $pages)
  {
    $this->pages = $pages;
  }

  /**
   * @return string
   */
  public function getAuthorName()
  {
    return $this->authorName;
  }

  /**
   * @param string $authorName
   */
  public function setAuthorName($authorName): void
  {
    $this->authorName = $authorName;
  }

  /**
   * @return string
   */
  public function getAuthorSurname()
  {
    return $this->authorSurname;
  }

  /**
   * @param string $authorSurname
   */
  public function setAuthorSurname($authorSurname): void
  {
    $this->authorSurname = $authorSurname;
  }

  /**
   * @return string
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * @param string $description
   */
  public function setDescription($description): void
  {
    $this->description = $description;
  }

  /**
   * @return array
   */
  public function getCategories(): Category
  {
    return $this->categories;
  }

  /**
   * @param array $categories
   */
  public function setCategories(array $categories): void
  {
    $this->categories = $categories;
  }


}