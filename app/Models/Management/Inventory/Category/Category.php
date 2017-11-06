<?php

namespace App\Models\Management\Inventory\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Management\Inventory\Category\Traits\Scope\CategoryScope;
use App\Models\Management\Inventory\Category\Traits\CategorySendPasswordReset;
use App\Models\Management\Inventory\Category\Traits\Attribute\CategoryAttribute;
use App\Models\Management\Inventory\Category\Traits\Relationship\CategoryRelationship;

/**
* Class Category.
*/
class Category extends Model
{
   use SoftDeletes,
   CategoryRelationship,
   CategoryAttribute;

   /**
   * The database table used by the model.
   *
   * @var string
   */
   protected $table;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = ['name'];

   /**
   * @var array
   */
   protected $dates = ['deleted_at'];

   /**
   * @param array $attributes
   */
   public function __construct(array $attributes = [])
   {
      parent::__construct($attributes);
      $this->table = config('management.inventory.categories_table');
   }
}
