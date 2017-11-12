<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

  protected $fillable = [
    'name',
  ];

    public function feature_groups() {
      return $this->belongsToMany('App\FeatureGroup', 'features_feature_groups', 'feature_id', 'feature_group_id');
    }

    public static function getByUserInput($input) {

      if (is_numeric($input)) {
        return Feature::find($input);
      }

      return Feature::where('name',$input)->first();

    }

}
