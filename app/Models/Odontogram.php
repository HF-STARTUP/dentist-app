<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Odontogram extends Model
{
  protected $fillable = [
    'user_id',
    'tooth',
    'detail'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
