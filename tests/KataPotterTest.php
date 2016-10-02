<?php

use KataPotter\Book;
use KataPotter\KataPotter;

class KataPotterTest extends \PHPUnit_Framework_TestCase {
  /** @test */
  public function one_book_has_no_discount() {
    $kataPotter = new KataPotter();

    $book = new Book();
    $price = $kataPotter->priceOf([$book]);

    $this->assertEquals(8.00, $price);
  }
}