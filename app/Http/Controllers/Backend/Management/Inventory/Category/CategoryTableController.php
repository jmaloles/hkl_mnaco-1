<?php

namespace App\Http\Controllers\Backend\Management\Inventory\Category;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Management\Inventory\Category\CategoryRepository;
use App\Http\Requests\Backend\Management\Inventory\Category\ManageCategoryRequest;

/**
* Class CategoryTableController.
*/
class CategoryTableController extends Controller
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
   public function __invoke(ManageCategoryRequest $request)
   {
      return Datatables::of($this->categories->getForDataTable($request->get('trashed')))
      ->escapeColumns(['name'])
      ->editColumn('number_of_assets', function($category) {
         return $category->assets->count();
      })
      ->addColumn('actions', function($category) {
         return $category->action_buttons;
      })
      ->withTrashed()
      ->make(true);
   }
}
