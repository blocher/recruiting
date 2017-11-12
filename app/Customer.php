<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
    'name',
    'feature_group_id'
  ];

  /**
   * Return an instance of Customer given a customer's `id` or `name`
   *
   * @param mixed $input (Integer for `id` or string from `name`)
   *
   * @return \App\Customer
   */

  public static function getByUserInput($input) {

    if (is_numeric($input)) {
      return Customer::find($input);
    }

    return Customer::where('name',$input)->first();

  }

  /**
   * Belongs to relationship for single feature group that a customer belongs to
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function featureGroup() {
    return $this->belongsTo('App\FeatureGroup');
  }

  /**
   * Returns BelongsToMany relationship between the associated feature group and
   * features in that group
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function features() {
    return $this->featureGroup->features();
  }

  /**
   * Returns feature if customer is assigned feature or false if it is not associated
   *
   * @param int $feature_id
   *
   * @return \App\Feature | boolean
   */
  public function hasFeature(int $feature_id) {
    return $this->featureGroup->features()->where('features.id',$feature_id)->first();
  }

}
