<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
    'name',
    'feature_group_id'
  ];

}
