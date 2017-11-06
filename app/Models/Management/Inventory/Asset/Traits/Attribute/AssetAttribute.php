<?php

namespace App\Models\Management\Inventory\Asset\Traits\Attribute;

/**
* Class AssetAttribute.
*/
trait AssetAttribute
{
   /**
   * @return string
   */
   public function getStatusLabelAttribute()
   {
      if ($this->status == 1) {
         return "<label class='label label-success'>".trans('labels.backend.management.inventory.asset.active').'</label>';
      } elseif ($this->status == 2) {
         return "<label class='label label-danger'>Deleted Asset</label>";
      }

      return "<label class='label label-danger'>".trans('labels.backend.management.inventory.asset.inactive').'</label>';
   }

   /**
   * @return bool
   */
   public function isActive()
   {
      return $this->status == 1;
   }

   /**
   * @return string
   */
   public function getShowButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.asset.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.view').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getEditButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.asset.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getDeleteButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.asset.destroy', $this).'"
      data-method="delete"
      data-trans-button-cancel="'.trans('buttons.general.cancel').'"
      data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
      data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
      class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getRestoreButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.asset.restore', $this).'" name="restore_asset" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.inventory.asset.restore_asset').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getDeletePermanentlyButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.asset.delete-permanently', $this).'" name="delete_asset_perm" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.inventory.asset.delete_permanently').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getActionButtonsAttribute()
   {
      if ($this->trashed()) {
         return $this->restore_button.$this->delete_permanently_button;
      }

      return
      $this->show_button.
      $this->edit_button.
      $this->delete_button;
   }
}
