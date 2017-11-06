<?php

namespace App\Repositories\Backend\Management\Inventory\Asset;

use App\Models\Management\Inventory\Asset\Asset;
use App\Models\Management\Inventory\Category\Category;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\Management\Inventory\Asset\AssetCreated;
use App\Events\Backend\Management\Inventory\Category\CategoryCreated;
use App\Events\Backend\Management\Inventory\Asset\AssetDeleted;
use App\Events\Backend\Management\Inventory\Asset\AssetUpdated;
use App\Events\Backend\Management\Inventory\Asset\AssetRestored;
use App\Events\Backend\Management\Inventory\Asset\AssetPermanentlyDeleted;

/**
* Class AssetRepository.
*/
class AssetRepository extends BaseRepository
{
   /**
   * Associated Repository Model.
   */
   const MODEL = Asset::class;

   /**
   * @param int  $status
   * @param bool $trashed
   *
   * @return mixed
   */
   public function getForDataTable($status = 1, $trashed = false, $category_type = 0)
   {
      /**
      * Note: You must return deleted_at or the Asset getActionButtonsAttribute won't
      * be able to differentiate what buttons to show for each row.
      */
      $dataTableQuery = $this->query()
      ->leftJoin(config('management.inventory.categories_table'), config('management.inventory.assets_table').'.category_id', '=', config('management.inventory.categories_table').'.id')
      ->select
      ([
         DB::raw(config('management.inventory.categories_table').'.id as "category_id"'),
         DB::raw(config('management.inventory.categories_table').'.name as "asset_type"'),
         config('management.inventory.assets_table').'.id',
         config('management.inventory.assets_table').'.name',
         config('management.inventory.assets_table').'.serial_number',
         config('management.inventory.assets_table').'.eas_tag',
         config('management.inventory.assets_table').'.status',
         config('management.inventory.assets_table').'.created_at',
         config('management.inventory.assets_table').'.updated_at',
         config('management.inventory.assets_table').'.deleted_at',
      ]);

      if ($trashed == 'true') {
         return $dataTableQuery->onlyTrashed();
      }

      if ($category_type != 0) {
         /**
          * If category_type/category_id returns an int value
          * return active assets based on the category_type/category_id
          */
         return $dataTableQuery->categoryType($category_type)->active($status);

      } elseif ($category_type == 0) {
         /**
          * If category_type/category_id returns 0 value
          * get all active assets
          */
         // active() is a scope on the AssetScope trait
         return $dataTableQuery->active($status);
      }
   }

   /**
   * @param array $input
   */
   public function create($input)
   {
      $data = $input['data'];

      $asset = $this->createAssetStub($data);

      DB::transaction(function () use ($asset, $data) {
         $category = Category::firstOrNew(['name' => $data['category']]);

         if($category->exists) {
            $asset->category_id = $category->id;

            if ($asset->save()) {
               event(new AssetCreated($asset));

               return true;
            }
         } else {
            if($category->save()) {
               $asset->category_id = $category->id;

               if ($asset->save()) {
                  event(new AssetCreated($asset));
                  event(New CategoryCreated($category));

                  return true;
               }
            }
         }

         throw new GeneralException(trans('exceptions.backend.management.inventory.asset.create_error'));
      });
   }

   /**
   * @param Model $asset
   * @param array $input
   *
   * @return bool
   * @throws GeneralException
   */
   public function update(Model $asset, array $input)
   {
      $data = $input['data'];

      $asset->name            = $data['name'];
      $asset->serial_number   = $data['serial_number'];
      $asset->eas_tag         = $data['eas_tag'];
      $asset->category_id     = isset($data['category']) ? $data['category'] : 0;
      $asset->status          = isset($data['status']) ? 1 : 0;

      DB::transaction(function () use ($asset, $data) {
         if ($asset->save()) {
            event(new AssetUpdated($asset));

            return true;
         }

         throw new GeneralException(trans('exceptions.backend.management.inventory.asset.update_error'));
      });
   }

   /**
   * @param Model $asset
   *
   * @throws GeneralException
   *
   * @return bool
   */
   public function delete(Model $asset)
   {
      $asset->update(['status' => 2]);

      if ($asset->delete()) {
         // Change status to 2 (Deleted Asset)
         event(new AssetDeleted($asset));

         return true;
      }

      throw new GeneralException(trans('exceptions.backend.management.inventory.asset.delete_error'));
   }

   /**
   * @param Model $asset
   *
   * @throws GeneralException
   */
   public function forceDelete(Model $asset)
   {
      if (is_null($asset->deleted_at)) {
         throw new GeneralException(trans('exceptions.backend.management.inventory.asset.delete_first'));
      }

      DB::transaction(function () use ($asset) {
         if ($asset->forceDelete()) {
            event(new AssetPermanentlyDeleted($asset));

            return true;
         }

         throw new GeneralException(trans('exceptions.backend.management.inventory.asset.delete_error'));
      });
   }

   /**
   * @param Model $asset
   *
   * @throws GeneralException
   *
   * @return bool
   */
   public function restore(Model $asset)
   {
      if (is_null($asset->deleted_at)) {
         throw new GeneralException(trans('exceptions.backend.management.inventory.asset.cant_restore'));
      }

      $asset->update(['status' => 1]);
      if ($asset->restore()) {
         // Change deleted asset status to 1 (Ready to Deploy)
         event(new AssetRestored($asset));

         return true;
      }

      throw new GeneralException(trans('exceptions.backend.management.inventory.asset.restore_error'));
   }

   /**
   * @param  $input
   *
   * @return mixed
   */
   protected function createAssetStub($input)
   {
      $asset                  = self::MODEL;
      $asset                  = new $asset;
      $asset->name            = $input['name'];
      $asset->category_id     = 0;
      $asset->serial_number   = $input['serial_number'];
      $asset->eas_tag         = $input['eas_tag'];
      $asset->status          = isset($input['status']) ? 1 : 0;

      return $asset;
   }
}
