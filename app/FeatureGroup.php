<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class FeatureGroup extends Model
{


  protected $fillable = [
    'name',
    'percentage',
  ];


   /**
   * Belongs to Many Relationship for features that Feature Group contains
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function features() {
    return $this->belongsToMany('App\Feature', 'features_feature_groups', 'feature_group_id', 'feature_id');
  }


}
