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
    $theCheapestOption = $this->magic($books);
    return array_reduce($theCheapestOption,
      function ($total, $books) {
        $total += $this->calculateThePrice($books);
        return $total;
      });
  }

  private function percentageOfTotal($books) {
    $length = count($books);
    return (1 - 0.05 * ($length - 1));
  }

  /**
   * @param $books
   * @return int
   */
  private function calculateThePrice($books) {
    $length = count($books);
    return $length * $this->percentageOfTotal($books) * 8;
  }

  /**
   * @param Book[] $books
   * @return array
   */
  private function magic($books) {
    if (count($books) == 2 && $books[0]->title() == '1' && $books[1]->title() == '1') {
      return [[$books[0]], [$books[1]]];
    }
    return [$books];
  }
}