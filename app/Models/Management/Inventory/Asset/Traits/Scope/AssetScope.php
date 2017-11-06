<?php

namespace App\Models\Management\Inventory\Asset\Traits\Scope;

/**
* Class AssetScope.
*/
trait AssetScope
{
   /**
   * @param $query
   * @param bool $status
   *
   * @return mixed
   */
   public function scopeActive($query, $status = true)
   {
      return $query->where('status', $status);
   }

   /**
   * @param $query
   * @param $category_type
   *
   * @return mixed
   */
   public function scopeCategoryType($query, $category_type = 0)
   {
      return $query->where('category_id', $category_type);
   }
}
