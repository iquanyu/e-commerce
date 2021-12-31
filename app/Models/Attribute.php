<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Attribute extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
    'name',
    'type',
    'position',
    'is_required',
    'is_unique',
    'validation',
    'is_configurable',
    'is_visible_on_front',
    'is_user_defined',
    'swatch_type',
    'is_comparable',
  ];

  /**
   * Get the options.
   */
  public function options()
  {
    return $this->hasMany(AttributeOption::class);
  }

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%');
    })->when($filters['type'] ?? null, function ($query, $type) {
      if (!is_null($type)) {
        $query->where('type', $type);
      }
    });
  }
}
