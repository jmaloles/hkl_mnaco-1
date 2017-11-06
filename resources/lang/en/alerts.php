<?php

return [

   /*
   |--------------------------------------------------------------------------
   | Alert Language Lines
   |--------------------------------------------------------------------------
   |
   | The following language lines contain alert messages for various scenarios
   | during CRUD operations. You are free to modify these language lines
   | according to your application's requirements.
   |
   */

   'backend' => [
      'management'   => [
         'inventory' => [
            'asset' => [
               'created' => 'Asset :asset was successfully created.',
               'deleted' => 'Asset :asset was successfully deleted.',
               'updated' => 'Asset :asset was successfully updated.',
               'restored'=> 'Asset :asset was successfully restored.',
               'deleted_permanently' => 'The asset was deleted permanently.',
            ],

            'category' => [
               'created' => 'Category :category was successfully created.',
               'deleted' => 'Category :category was successfully deleted, and all ASSETS associated with this category is now labeled as "Uncategorized Asset".',
               'updated' => 'Category :category was successfully updated.',
               'restored'=> 'Category :category was successfully restored.',
               'deleted_permanently' => 'The category was deleted permanently.',
            ],
         ]
      ],

      'roles' => [
         'created' => 'The role was successfully created.',
         'deleted' => 'The role was successfully deleted.',
         'updated' => 'The role was successfully updated.',
      ],

      'users' => [
         'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
         'confirmation_email'  => 'A new confirmation e-mail has been sent to the address on file.',
         'confirmed'              => 'The user was successfully confirmed.',
         'created'             => 'The user was successfully created.',
         'deleted'             => 'The user was successfully deleted.',
         'deleted_permanently' => 'The user was deleted permanently.',
         'restored'            => 'The user was successfully restored.',
         'session_cleared'      => "The user's session was successfully cleared.",
         'social_deleted' => 'Social Account Successfully Removed',
         'unconfirmed' => 'The user was successfully un-confirmed',
         'updated'             => 'The user was successfully updated.',
         'updated_password'    => "The user's password was successfully updated.",
      ],
   ],

   'frontend' => [
      'contact' => [
         'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
      ],
   ],
];
