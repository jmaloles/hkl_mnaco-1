<?php

namespace App\Models\Management\Inventory\Category\Traits\Attribute;

/**
* Class CategoryAttribute.
*/
trait CategoryAttribute
{

   /**
   * @return string
   */
   public function getShowButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.category.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.view').'"></i></a> ';
   }

   /**
   * @return string
   */
   // public function getAddButtonAttribute()
   // {
   //    return '<a href="'.route('admin.management.inventory.category.associate_asset', $this).'" class="btn btn-xs btn-success"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.inventory.category.associate_assets').'"></i></a> ';
   // }

   /**
   * @return string
   */
   public function getEditButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.category.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getDeleteButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.category.destroy', $this).'"
      data-method="delete"
      data-trans-button-cancel="'.trans('buttons.general.cancel').'"
      data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
      data-trans-title="'.trans('strings.backend.management.inventory.category.are_you_sure').'"
      data-trans-text="'.trans('strings.backend.management.inventory.category.are_you_sure_confirm').'"
      class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getRestoreButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.category.restore', $this).'" name="restore_category" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.inventory.category.restore_category').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getDeletePermanentlyButtonAttribute()
   {
      return '<a href="'.route('admin.management.inventory.category.delete-permanently', $this).'" name="delete_category_perm" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.inventory.category.delete_permanently').'"></i></a> ';
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
      // $this->add_button.
      $this->show_button.
      $this->edit_button.
      $this->delete_button;
   }
}
