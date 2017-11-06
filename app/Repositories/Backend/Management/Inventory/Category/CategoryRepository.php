<?php

namespace App\Repositories\Backend\Management\Inventory\Category;

use App\Models\Management\Inventory\Category\Category;
use App\Models\Management\Inventory\Asset\Asset;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\Management\Inventory\Category\CategoryCreated;
use App\Events\Backend\Management\Inventory\Category\CategoryDeleted;
use App\Events\Backend\Management\Inventory\Category\CategoryUpdated;
use App\Events\Backend\Management\Inventory\Category\CategoryRestored;
use App\Events\Backend\Management\Inventory\Category\CategoryPermanentlyDeleted;

/**
* Class CategoryRepository.
*/
class CategoryRepository extends BaseRepository
{
   /**
   * Associated Repository Model.
   */
   const MODEL = Category::class;

   /**
   * @param int  $status
   * @param bool $trashed
   *
   * @return mixed
   */
   public function getForDataTable($trashed = false)
   {
      /**
      * Note: You must return deleted_at or the Category getActionButtonsAttribute won't
      * be able to differentiate what buttons to show for each row.
      */
      // $dataTableQuery = $this->query()
      // ->leftJoin(config('management.inventory.categories_table'), config('management.inventory.categories_table').'.category_id', '=', config('management.inventory.categories_table').'.id')
      // ->select
      // ([
      //    DB::raw(config('management.inventory.categories_table').'.id as "category_id"'),
      //    DB::raw(config('management.inventory.categories_table').'.name as "asset_type"'),
      //    config('management.inventory.categories_table').'.id',
      //    config('management.inventory.categories_table').'.name',
      //    config('management.inventory.categories_table').'.serial_number',
      //    config('management.inventory.categories_table').'.eas_tag',
      //    config('management.inventory.categories_table').'.status',
      //    config('management.inventory.categories_table').'.created_at',
      //    config('management.inventory.categories_table').'.updated_at',
      //    config('management.inventory.categories_table').'.deleted_at',
      // ]);

      $dataTableQuery = $this->query()->with(['assets']);

      if ($trashed == 'true') {
         return $dataTableQuery->onlyTrashed();
      }

      return $dataTableQuery;
   }

   /**
   * @param array $input
   */
   public function create($input)
   {
      $data = $input['data'];

      $category = $this->createCategoryStub($data);

      DB::transaction(function () use ($category, $data) {
         if ($category->save()) {
            event(new CategoryCreated($category));

            return true;
         }

         throw new GeneralException(trans('exceptions.backend.management.inventory.category.create_error'));
      });
   }

   /**
   * @param Model $category
   * @param array $input
   *
   * @return bool
   * @throws GeneralException
   */
   public function update(Model $category, array $input)
   {
      $data = $input['data'];

      $category->name            = $data['name'];

      DB::transaction(function () use ($category, $data) {
         if ($category->save()) {
            event(new CategoryUpdated($category));

            return true;
         }

         throw new GeneralException(trans('exceptions.backend.management.inventory.category.update_error'));
      });
   }

   /**
   * @param Model $category
   *
   * @throws GeneralException
   *
   * @return bool
   */
   public function delete(Model $category)
   {
      Asset::where('category_id', $category->id)->update(['category_id' => 0]);

      if ($category->delete()) {
         // Change status to 2 (Deleted Category)
         event(new CategoryDeleted($category));

         return true;
      }

      throw new GeneralException(trans('exceptions.backend.management.inventory.category.delete_error'));
   }

   /**
   * @param Model $category
   *
   * @throws GeneralException
   */
   public function forceDelete(Model $category)
   {
      if (is_null($category->deleted_at)) {
         throw new GeneralException(trans('exceptions.backend.management.inventory.category.delete_first'));
      }

      DB::transaction(function () use ($category) {
         if ($category->forceDelete()) {
            event(new CategoryPermanentlyDeleted($category));

            return true;
         }

         throw new GeneralException(trans('exceptions.backend.management.inventory.category.delete_error'));
      });
   }

   /**
   * @param Model $category
   *
   * @throws GeneralException
   *
   * @return bool
   */
   public function restore(Model $category)
   {
      if (is_null($category->deleted_at)) {
         throw new GeneralException(trans('exceptions.backend.management.inventory.category.cant_restore'));
      }

      $category->update(['status' => 1]);
      if ($category->restore()) {
         // Change deleted category status to 1 (Ready to Deploy)
         event(new CategoryRestored($category));

         return true;
      }

      throw new GeneralException(trans('exceptions.backend.management.inventory.category.restore_error'));
   }

   /**
   * @param  $input
   *
   * @return mixed
   */
   protected function createCategoryStub($input)
   {
      $category                  = self::MODEL;
      $category                  = new $category;
      $category->name            = $input['name'];

      return $category;
   }
}
