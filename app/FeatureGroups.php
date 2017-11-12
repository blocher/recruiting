<?php

namespace App;
use App\FeatureGroup;


class FeatureGroups
{

  private $limits = [];

  public function __construct() {

    $feature_groups = FeatureGroup::orderBy('percentage','DESC')->get();

    foreach ($feature_groups as $key=>&$value) {
      $value->lower_limit = isset ($feature_groups[$key-1]) ? $feature_groups[$key-1]->lower_limit + $value->percentage : $value->percentage;
      $this->limits[$value->id] = $value->lower_limit;
    }

  }

  public function assignFeatureGroup() {
    $rand = random_int(1,100); //using more evenly distributed random number generator
    foreach ($this->limits as $key => $value) {
      if ($rand<=$value) {
        return $key;
      }
    }
  }



}
