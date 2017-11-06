<?php

namespace App\Http\Controllers\Backend\Management\Inventory\Category;

use App\Models\Management\Inventory\Category\Category;
use App\Models\Management\Inventory\Asset\Asset;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Management\Inventory\Category\CategoryRepository;
use App\Http\Requests\Backend\Management\Inventory\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Management\Inventory\Category\ManageCategoryRequest;
use App\Http\Requests\Backend\Management\Inventory\Category\UpdateCategoryRequest;

/**
* Class CategoryController.
*/
class CategoryController extends Controller
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
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
   public function index(ManageCategoryRequest $request)
   {
      return view('backend.management.inventory.category.index');
   }

   /**
   * @param ManageCategoryRequest $request
   *
   * @return mixed
   */
   public function create(ManageCategoryRequest $request)
   {
      return view('backend.management.inventory.category.create');
   }

   /**
   * @param StoreCategoryRequest $request
   *
   * @return mixed
   */
   public function store(StoreCategoryRequest $request)
   {
      $this->categories->create(
      [
         'data' => $request->only(
            'name'
         ),
      ]);

      return redirect()->route('admin.management.inventory.category.index')->withFlashSuccess(trans('alerts.backend.management.inventory.category.created'));
   }

   /**
   * @param Category              $category
   * @param ManageCategoryRequest $request
   *
   * @return mixed
   */
   public function show(Category $category, ManageCategoryRequest $request)
   {
      return view('backend.management.inventory.category.show')->withCategory($category);
   }

   /**
   * @param Category              $category
   * @param Category           $category
   * @param ManageCategoryRequest $request
   *
   * @return mixed
   */
   public function edit(Category $category, ManageCategoryRequest $request)
   {
      $categories = Category::all();

      return view('backend.management.inventory.category.edit')->withCategory($category)->with('categories', $categories);
   }

   /**
   * @param Category              $category
   * @param UpdateCategoryRequest $request
   *
   * @return mixed
   */
   public function update(Category $category, UpdateCategoryRequest $request)
   {
      $this->categories->update($category,
      [
         'data' => $request->only(
            'name'
         )
      ]);

      return redirect()->route('admin.management.inventory.category.index')->withFlashSuccess(trans('alerts.backend.management.inventory.category.updated', ['category' => $category->name]));
   }

   /**
   * @param Category              $category
   * @param ManageCategoryRequest $request
   *
   * @return mixed
   */
   public function destroy(Category $category, ManageCategoryRequest $request)
   {
      $this->categories->delete($category);

      return redirect()->route('admin.management.inventory.category.deleted')->withFlashSuccess(trans('alerts.backend.management.inventory.category.deleted', ['category' => $category->name]));
   }

   // public function getAssociateAssets(ManageCategoryRequest $request)
   // {
   //    $assets = Asset::where('category_id', 0)->where('status', 1)->get();

   //    return view('backend.management.inventory.category.associate_assets', compact('assets'));
   // }
}
