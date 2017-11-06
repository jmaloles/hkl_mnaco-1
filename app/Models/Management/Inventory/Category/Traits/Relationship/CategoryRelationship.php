<?php

namespace App\Models\Management\Inventory\Category\Traits\Relationship;

/**
* Class CategoryRelationship.
*/
trait CategoryRelationship
{
   public function assets()
   {
      return $this->hasMany(config('management.inventory.asset'));
   }
}
