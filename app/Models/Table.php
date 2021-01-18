<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status'];

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function sales()
    {
      return $this->belongsToMany(Sale::class);
    }
}
