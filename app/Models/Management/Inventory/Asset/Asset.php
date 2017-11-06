<?php

namespace App\Models\Management\Inventory\Asset;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Management\Inventory\Asset\Traits\Scope\AssetScope;
use App\Models\Management\Inventory\Asset\Traits\AssetSendPasswordReset;
use App\Models\Management\Inventory\Asset\Traits\Attribute\AssetAttribute;
use App\Models\Management\Inventory\Asset\Traits\Relationship\AssetRelationship;

/**
* Class Asset.
*/
class Asset extends Model
{
   use SoftDeletes,
   AssetScope,
   AssetRelationship,
   AssetAttribute;

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
   protected $fillable = ['name', 'serial_number', 'category_id', 'eas_tag', 'status'];

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
      $this->table = config('management.inventory.assets_table');
   }
}
