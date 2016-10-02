<?php

use KataPotter\Book;
use KataPotter\KataPotter;

class KataPotterTest extends \PHPUnit_Framework_TestCase {
  /** @test */
  public function one_book_has_no_discount() {
    $kataPotter = new KataPotter();

    $book = new Book("1");
    $price = $kataPotter->priceOf([$book]);

    $this->assertEquals(8.00, $price);
  }

  /** @test */
  public function two_books_belonging_in_the_same_collection_has_discount() {
    $kataPotter = new KataPotter();

    $book1 = new Book("1");
    $book2 = new Book("2");
    $price = $kataPotter->priceOf([$book1, $book2]);

    $this->assertEquals(16 * 0.95, $price);
  }
}