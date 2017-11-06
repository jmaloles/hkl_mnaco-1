<?php

use App\Models\Management\Inventory\Asset\Asset;
use App\Models\Management\Inventory\Category\Category;


return [

   'inventory' => [
      'category'           => Category::class,
      'categories_table'   => 'categories',

      'asset'              => Asset::class,
      'assets_table'       => 'assets'
   ]

];
