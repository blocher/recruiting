<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{

  protected $fillable = [
    'name',
  ];

    /**
     * Belongs to Many Relationship for feature groups that Feature belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function feature_groups() {
      return $this->belongsToMany('App\FeatureGroup', 'features_feature_groups', 'feature_id', 'feature_group_id');
    }

     /**
     * Return an instance of Fetaure given a features's `id` or `name`
     *
     * @param mixed $input (Integer for `id` or string from `name`)
     *
     * @return \App\Feature
     */

    public static function getByUserInput($input) {

      if (is_numeric($input)) {
        return Feature::find($input);
      }

      return Feature::where('name',$input)->first();

    }

}
