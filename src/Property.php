<?php

class Property
{
  /**
   * @var string
   */
  public $name;

  /**
   * @param string $name
   */
  public function __construct($name)
  {
    $this->name = $name;
  }

  /**
   * @return array
   */
  public function gen()
  {
    return array(array(array(1, 2), array(3, 4)));
  }

  /**
   * @param Closure $f
   * @param Traversable $gen
   * @return Property
   */
  public function forAll(Closure $f, Traversable $gen = null)
  {
    if (!$gen) {
      $gen = $this->gen();
    }
    foreach ($gen as $data) {
      if (!$f($data[0], $data[1])) {
        die(sprintf('Property "%s". Failed at : %s, %s.', $this->name, print_r($data[0], true), print_r($data[1], true)));
      }
    }
    die(sprintf('Property "%s". Tests passed.', $this->name));
  }

  /**
   *
   */
  public function check()
  {
    return $this;
  }
}

$property = new Property("Lalala");
$property->forAll(function (array $a, array $b) {
  return count($a) + count($b) !== count(array_merge($a, $b));
});

$property->check();