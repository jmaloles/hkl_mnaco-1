<?php

namespace App\Http\Controllers\Backend\Management\Inventory\Asset;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Management\Inventory\Asset\AssetRepository;
use App\Http\Requests\Backend\Management\Inventory\Asset\ManageAssetRequest;

/**
* Class AssetTableController.
*/
class AssetTableController extends Controller
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
   public function __invoke(ManageAssetRequest $request)
   {
      return Datatables::of($this->assets->getForDataTable($request->get('status'), $request->get('trashed'), $request->get('category_type')))
      ->escapeColumns(['name', 'serial_number', 'eas_tag'])
      ->editColumn('type', function ($model) {
         return $model->asset_type ? '<a href="' . route('admin.management.inventory.category.show', $model->category_id) . '">' . $model->asset_type . '</a>' : '<label class="label label-danger">Uncategorized Asset</label>';
      })
      ->editColumn('status', function ($asset) {
         return $asset->status_label;
      })
      ->addColumn('actions', function ($asset) {
         return $asset->action_buttons;
      })
      ->withTrashed()
      ->make(true);
   }
}
