<?php

namespace App\Http\Controllers\Backend\Management\Inventory\Asset;

use App\Models\Management\Inventory\Asset\Asset;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Management\Inventory\Asset\AssetRepository;
use App\Http\Requests\Backend\Management\Inventory\Asset\ManageAssetRequest;

/**
* Class AssetStatusController.
*/
class AssetStatusController extends Controller
{
   /**
   * @var AssetRepository
   */
   protected $assets;

   /**
   * @param AssetRepository $assets
   */
   public function __construct(AssetRepository $assets)
   {
      $this->assets = $assets;
   }

   /**
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function getDeactivated(ManageAssetRequest $request)
   {
      return view('backend.management.inventory.deactivated');
   }

   /**
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function getDeleted(ManageAssetRequest $request)
   {
      return view('backend.management.inventory.asset.deleted');
   }

   /**
   * @param Asset              $deletedAsset
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function delete(Asset $deletedAsset, ManageAssetRequest $request)
   {
      $this->assets->forceDelete($deletedAsset);

      return redirect()->route('admin.management.inventory.asset.deleted')->withFlashSuccess(trans('alerts.backend.management.inventory.asset.deleted_permanently', ['asset' => $deletedAsset->name]));
   }

   /**
   * @param Asset              $deletedAsset
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function restore(Asset $deletedAsset, ManageAssetRequest $request)
   {
      $this->assets->restore($deletedAsset);

      return redirect()->route('admin.management.inventory.asset.index')->withFlashSuccess(trans('alerts.backend.management.inventory.asset.restored', ['asset' => $deletedAsset->name]));
   }
}
