<?php

class Property
{
}

class Prop
{
  public function forAll($f)
  {
    return new Property($f);
  }
}

$prop = new Prop();
$property1 = $prop->forAll(function (array $a, array $b) {
  return count($a) + count($b) === count(array_merge($a, $b));
});
