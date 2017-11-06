<?php

namespace App\Http\Controllers\Backend\Management\Inventory\Category;

use App\Models\Management\Inventory\Category\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Management\Inventory\Category\CategoryRepository;
use App\Http\Requests\Backend\Management\Inventory\Category\ManageCategoryRequest;

/**
* Class CategoryStatusController.
*/
class CategoryStatusController extends Controller
{
   /**
   * @var CategoryRepository
   */
   protected $categories;

   /**
   * @param CategoryRepository $categories
   */
   public function __construct(CategoryRepository $categories)
   {
      $this->categories = $categories;
   }

   /**
   * @param ManageCategoryRequest $request
   *
   * @return mixed
   */
   public function getDeleted(ManageCategoryRequest $request)
   {
      return view('backend.management.inventory.category.deleted');
   }

   /**
   * @param Category              $deletedCategory
   * @param ManageCategoryRequest $request
   *
   * @return mixed
   */
   public function delete(Category $deletedCategory, ManageCategoryRequest $request)
   {
      $this->categories->forceDelete($deletedCategory);

      return redirect()->route('admin.management.inventory.category.deleted')->withFlashSuccess(trans('alerts.backend.management.inventory.category.deleted_permanently', ['category' => $deletedCategory->name]));
   }

   /**
   * @param Category              $deletedCategory
   * @param ManageCategoryRequest $request
   *
   * @return mixed
   */
   public function restore(Category $deletedCategory, ManageCategoryRequest $request)
   {
      $this->categories->restore($deletedCategory);

      return redirect()->route('admin.management.inventory.category.index')->withFlashSuccess(trans('alerts.backend.management.inventory.category.restored', ['category' => $deletedCategory->name]));
   }
}
