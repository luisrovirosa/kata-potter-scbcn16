<?php

namespace KataPotter;

class KataPotter {

  /**
   * KataPotter constructor.
   */
  public function __construct() {
  }

  /**
   * @param $books
   * @return float
   */
  public function priceOf($books) {
    $length = count($books);
    return $length * $this->percentageOfTotal($books) * 8;
  }

  private function percentageOfTotal($books) {
    $length = count($books);
    return (1 - 0.05 * ($length - 1));
  }
}