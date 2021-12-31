<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeFamily extends Model
{
  use HasFactory;

  public $timestamps = false;


  protected $fillable = ['code', 'name'];

  /**
   * Get all of the attribute groups.
   */
  public function attribute_groups()
  {
    return $this->hasMany(AttributeGroup::class)->orderBy('position');
  }

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%');
    })->when($filters['status'] ?? null, function ($query, $status) {
      if (!is_null($status)) {
        $query->where('status', $status);
      }
    });
  }
}
