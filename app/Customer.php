<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
    'name',
    'feature_group_id'
  ];

  public static function getByUserInput($input) {

    if (is_numeric($input)) {
      return Customer::find($input);
    }

    return Customer::where('name',$input)->first();

  }

  public function featureGroup() {
    return $this->belongsTo('App\FeatureGroup');
  }

  public function features() {
    return $this->featureGroup->features();
  }

  public function hasFeature(int $feature_id) {
    return $this->featureGroup->features()->where('features.id',$feature_id)->first();
  }

}
