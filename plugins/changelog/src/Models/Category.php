<?php

namespace Azuriom\Plugin\Changelog\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $position
 * @property bool $is_enabled
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Azuriom\Plugin\Category\Models\Category $parent
 * @property \Illuminate\Support\Collection|\Azuriom\Plugin\Category\Models\Category[] $categories
 * @property \Illuminate\Support\Collection|\Azuriom\Plugin\Category\Models\Update[] $updates
 *
 * @method static \Illuminate\Database\Eloquent\Builder parents()
 * @method static \Illuminate\Database\Eloquent\Builder enabled()
 */
class Category extends Model
{
 use HasTablePrefix;

 /**
  * The table prefix associated with the model.
  *
  * @var string
  */
 protected $prefix = 'changelog_';

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [
  'name', 'position', 'is_enabled',
 ];

 /**
  * The attributes that should be cast to native types.
  *
  * @var array
  */
 protected $casts = [
  'is_enabled' => 'boolean',
 ];

 /**
  * Get the category.
  */
 public function category()
 {
  return $this->orderBy('position');
 }

 /**
  * Get the updates in this category.
  */
 public function updates()
 {
  return $this->hasMany(Update::class);
 }

 /**
  * Scope a query to only include enabled categories.
  *
  * @param  \Illuminate\Database\Eloquent\Builder  $query
  * @return \Illuminate\Database\Eloquent\Builder
  */
 public function scopeEnabled(Builder $query)
 {
  return $query->where('is_enabled', true)->orderBy('position');
 }
}
