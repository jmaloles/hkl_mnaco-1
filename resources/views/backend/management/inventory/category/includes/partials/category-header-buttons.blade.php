<div class="pull-right mb-10 hidden-sm hidden-xs">
   {{ link_to_route('admin.management.inventory.category.index', trans('menus.backend.management.inventory.category.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
   {{ link_to_route('admin.management.inventory.category.create', trans('menus.backend.management.inventory.category.create'), [], ['class' => 'btn btn-success btn-xs']) }}
   {{-- {{ link_to_route('admin.management.inventory.category.deactivated', trans('menus.backend.management.inventory.category.deactivated'), [], ['class' => 'btn btn-warning btn-xs']) }} --}}
   {{ link_to_route('admin.management.inventory.category.deleted', trans('menus.backend.management.inventory.category.deleted'), [], ['class' => 'btn btn-danger btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
   <div class="btn-group">
      <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
         {{ trans('menus.backend.management.inventory.category.main') }} <span class="caret"></span>
      </button>

      <ul class="dropdown-menu" role="menu">
         <li>{{ link_to_route('admin.management.inventory.category.index', trans('menus.backend.management.inventory.category.all')) }}</li>
         <li>{{ link_to_route('admin.management.inventory.category.create', trans('menus.backend.management.inventory.category.create')) }}</li>
         <li class="divider"></li>
         {{-- <li>{{ link_to_route('admin.management.inventory.category.deactivated', trans('menus.backend.management.inventory.category.deactivated')) }}</li> --}}
         <li>{{ link_to_route('admin.management.inventory.category.deleted', trans('menus.backend.management.inventory.category.deleted')) }}</li>
      </ul>
   </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
