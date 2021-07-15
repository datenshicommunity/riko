<?php

namespace Azuriom\Plugin\Changelog\Models;

use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Azuriom\Plugin\Category\Models\Category $category
 *
 * @method static \Illuminate\Database\Eloquent\Builder enabled()
 */
class Update extends Model
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
  'category_id', 'name', 'description',
 ];

 /**
  * Get the category of this package.
  */
 public function category()
 {
  return $this->belongsTo(Category::class);
 }

 public function getDescription()
 {
  return $this->description;
 }
}
