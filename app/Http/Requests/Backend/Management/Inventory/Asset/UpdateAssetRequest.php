<?php

namespace App\Http\Requests\Backend\Management\Inventory\Asset;

use App\Http\Requests\Request;

/**
 * Class UpdateAssetRequest.
 */
class UpdateAssetRequest extends Request
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return access()->allow('view-backend');
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      return [
         'name'            => 'required|max:30',
         'serial_number'   => 'max:30',
         'eas_tag'         => 'max:30'
      ];
   }
}
