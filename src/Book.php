<?php

namespace KataPotter;

class Book {
  private $id;
  /**
   * @var string
   */
  private $title;

  /**
   * Book constructor.
   * @param string $title
   */
  public function __construct($title) {
    $this->id = rand();
    $this->title = $title;
  }

  public function title() {
    return $this->title;
  }

  public function compare(Book $b) {
    return $this->id - $b->id;
  }

}