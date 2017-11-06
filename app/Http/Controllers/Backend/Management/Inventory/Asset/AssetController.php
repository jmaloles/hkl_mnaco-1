<?php

namespace App\Http\Controllers\Backend\Management\Inventory\Asset;

use App\Models\Management\Inventory\Asset\Asset;
use App\Models\Management\Inventory\Category\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Management\Inventory\Asset\AssetRepository;
use App\Http\Requests\Backend\Management\Inventory\Asset\StoreAssetRequest;
use App\Http\Requests\Backend\Management\Inventory\Asset\ManageAssetRequest;
use App\Http\Requests\Backend\Management\Inventory\Asset\UpdateAssetRequest;

/**
* Class AssetController.
*/
class AssetController extends Controller
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
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
   public function index(ManageAssetRequest $request)
   {
      return view('backend.management.inventory.asset.index');
   }

   /**
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function create(ManageAssetRequest $request)
   {
      return view('backend.management.inventory.asset.create');
   }

   /**
   * @param StoreAssetRequest $request
   *
   * @return mixed
   */
   public function store(StoreAssetRequest $request)
   {
      $this->assets->create(
      [
         'data' => $request->only(
            'name',
            'category',
            'serial_number',
            'eas_tag',
            'status'
         ),
      ]);

      return redirect()->route('admin.management.inventory.asset.index')->withFlashSuccess(trans('alerts.backend.management.inventory.asset.created'));
   }

   /**
   * @param Asset              $asset
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function show(Asset $asset, ManageAssetRequest $request)
   {
      return view('backend.management.inventory.asset.show')->withAsset($asset);
   }

   /**
   * @param Asset              $asset
   * @param Category           $category
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function edit(Asset $asset, ManageAssetRequest $request)
   {
      $categories = Category::all();

      return view('backend.management.inventory.asset.edit')->withAsset($asset)->with('categories', $categories);
   }

   /**
   * @param Asset              $asset
   * @param UpdateAssetRequest $request
   *
   * @return mixed
   */
   public function update(Asset $asset, UpdateAssetRequest $request)
   {
      $this->assets->update($asset,
      [
         'data' => $request->only(
            'name',
            'serial_number',
            'eas_tag',
            'status',
            'category'
         )
      ]);

      return redirect()->route('admin.management.inventory.asset.index')->withFlashSuccess(trans('alerts.backend.management.inventory.asset.updated', ['asset' => $asset->name]));
   }

   /**
   * @param Asset              $asset
   * @param ManageAssetRequest $request
   *
   * @return mixed
   */
   public function destroy(Asset $asset, ManageAssetRequest $request)
   {
      $this->assets->delete($asset);

      return redirect()->route('admin.management.inventory.asset.deleted')->withFlashSuccess(trans('alerts.backend.management.inventory.asset.deleted', ['asset' => $asset->name]));
   }
}
