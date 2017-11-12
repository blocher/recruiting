<?php

namespace App;
use App\FeatureGroup;


class FeatureGroups
{

  private $limits = [];

  /**
   * Constructor, calls setLimits function
   */
  public function __construct() {
    $this->setLimits();
  }

  /**
   * Sets limits used to assingn boundarides for each feature group based
   * on percentage chance of feature group being assigned to customer
   *
   * @return void
   */
  protected function setLimits() {

    $feature_groups = FeatureGroup::orderBy('percentage','DESC')->get();

    foreach ($feature_groups as $key=>&$value) {
      $value->lower_limit = isset ($feature_groups[$key-1]) ? $feature_groups[$key-1]->lower_limit + $value->percentage : $value->percentage;
      $this->limits[$value->id] = $value->lower_limit;
    }

  }

  /**
   * Returns the id of a feature group randomally selected based on the precentage chance each
   * group has to be selected
   *
   * @return int The id of the feature group being assigned
   */
  public function assignFeatureGroup() {
    $rand = random_int(1,100); //using more evenly distributed random number generator
    foreach ($this->limits as $key => $value) {
      if ($rand<=$value) {
        return $key;
      }
    }
  }



}
