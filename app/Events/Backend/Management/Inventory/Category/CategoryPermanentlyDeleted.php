<?php

namespace App\Events\Backend\Management\Inventory\Category;

use Illuminate\Queue\SerializesModels;

/**
* Class CategoryPermanentlyDeleted.
*/
class CategoryPermanentlyDeleted
{
   use SerializesModels;

   /**
   * @var
   */
   public $category;

   /**
   * @param $category
   */
   public function __construct($category)
   {
      $this->category = $category;
   }
}
