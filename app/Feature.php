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

}
