<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class FeatureGroup extends Model
{


  protected $fillable = [
    'name',
    'percentage',
  ];


  public function features() {
    return $this->belongsToMany('App\Feature', 'features_feature_groups', 'feature_group_id', 'feature_id');
  }


}
