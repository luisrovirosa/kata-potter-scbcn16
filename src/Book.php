<?php

namespace KataPotter;

class Book {
  /**
   * @var string
   */
  private $title;

  /**
   * Book constructor.
   * @param string $title
   */
  public function __construct($title) {
    $this->title = $title;
  }
  
  public function title(){
    return $this->title;
  }

}