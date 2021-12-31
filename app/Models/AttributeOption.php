<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
  use HasFactory;

  /**
   * 是否主动维护时间戳
   *
   * @var bool
   */
  public $timestamps = false;

  protected $fillable = [
    'name',
    'swatch_value',
    'order',
  ];

  /**
   * Get the attribute that owns the attribute option.
   */
  public function attribute()
  {
    return $this->belongsTo(Attribute::class());
  }
}
