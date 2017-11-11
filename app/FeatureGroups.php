<?php

namespace App;
use App\FeatureGroup;


class FeatureGroups
{

  private $limits = [];

  public function __construct() {

    $feature_groups = FeatureGroup::orderBy('percentage','DESC')->get();

    foreach ($feature_groups as $key=>&$value) {

      if ($key == 0 ) {
        $value->lower_limit = (int) $value->percentage;
        $this->limits[$value->id] = $value->lower_limit;
        continue;
      }

      $value->lower_limit = $feature_groups[$key-1]->lower_limit + $value->percentage;
      $this->limits[$value->id] = $value->lower_limit;
    }

  }

  public function assignFeatureGroup() {

    $mt_rand = rand(1,100);
    foreach ($this->limits as $key => $value) {
      if ($rand<=$value) {
        return $key;
      }
    }

    return 0;

  }



}
