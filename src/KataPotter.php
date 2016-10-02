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
    return $this->priceOfMegabucket($theCheapestOption);
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

    $combinations = static::pc_array_power_set($books);

    $megabucketsOfTwobucketsOnly = array_map(function ($combinedBooks) use ($books) {
      $complementaryBucket = array_udiff($books, $combinedBooks, function (Book $a, Book $b) {
        return $a->compare($b);
      });

      if (!$complementaryBucket) {
        return [$combinedBooks];
      }
      $megabucket = [$combinedBooks, $complementaryBucket];

      return $megabucket;
    }, $combinations);

    $this->printBuckets($combinations);

    array_filter($megabucketsOfTwobucketsOnly, function ($megabucket) {
      return count($megabucket) == 1 || $megabucket[0]->title() != $megabucket[1]->title();
    });

//    print_r("\n-----\n");

//    $this->printMegaBuckets($megabucketsOfTwobucketsOnly);

    usort($megabucketsOfTwobucketsOnly, function ($bucket1, $bucket2) {
      return $this->priceOfMegabucket($bucket1) - $this->priceOfMegabucket($bucket2);
    });
//
    return $megabucketsOfTwobucketsOnly[0];

    if (count($books) == 2 && $books[0]->title() == '1' && $books[1]->title() == '1') {
      return [[$books[0]], [$books[1]]];
    }
    return [$books];
  }

  // Not a copy of the recipe anymore
  private static function pc_array_power_set($array) {
    // initialize by adding the empty set
    $results = [[]];

    foreach ($array as $element) {
      foreach ($results as $combination) {
        array_push($results, array_merge(array($element), $combination));
      }
    }
    return array_slice($results, 1);
  }

  /**
   * @param $combinations
   */
  private function printBuckets($combinations) {
    array_map(function ($books) {
      array_map(function (Book $book) {
        print_r($book->title() . ",");
      }, $books);
      print_r("\n\n");
    }, $combinations);
  }

  private function printMegaBuckets($megabucket) {
    array_walk($megabucket, function ($bucket) {
      print_r("\n-----\n");
      $this->printBuckets($bucket);
    });
  }

  /**
   * @param $theCheapestOption
   * @return mixed
   */
  private function priceOfMegabucket($theCheapestOption) {
    return array_reduce($theCheapestOption,
      function ($total, $books) {
        $total += $this->calculateThePrice($books);
        return $total;
      });
  }
}
