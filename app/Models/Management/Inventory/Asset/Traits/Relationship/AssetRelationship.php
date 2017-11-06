<?php

namespace App\Models\Management\Inventory\Asset\Traits\Relationship;

/**
* Class AssetRelationship.
*/
trait AssetRelationship
{
   public function category()
   {
      return $this->belongsTo(config('management.inventory.category'));
   }
}
