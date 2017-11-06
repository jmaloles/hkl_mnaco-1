<div class="pull-right mb-10 hidden-sm hidden-xs">
   {{ link_to_route('admin.management.inventory.asset.index', trans('menus.backend.management.inventory.asset.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
   {{ link_to_route('admin.management.inventory.asset.create', trans('menus.backend.management.inventory.asset.create'), [], ['class' => 'btn btn-success btn-xs']) }}
   {{-- {{ link_to_route('admin.management.inventory.asset.deactivated', trans('menus.backend.management.inventory.asset.deactivated'), [], ['class' => 'btn btn-warning btn-xs']) }} --}}
   {{ link_to_route('admin.management.inventory.asset.deleted', trans('menus.backend.management.inventory.asset.deleted'), [], ['class' => 'btn btn-danger btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
   <div class="btn-group">
      <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
         {{ trans('menus.backend.management.inventory.asset.main') }} <span class="caret"></span>
      </button>

      <ul class="dropdown-menu" role="menu">
         <li>{{ link_to_route('admin.management.inventory.asset.index', trans('menus.backend.management.inventory.asset.all')) }}</li>
         <li>{{ link_to_route('admin.management.inventory.asset.create', trans('menus.backend.management.inventory.asset.create')) }}</li>
         <li class="divider"></li>
         {{-- <li>{{ link_to_route('admin.management.inventory.asset.deactivated', trans('menus.backend.management.inventory.asset.deactivated')) }}</li> --}}
         <li>{{ link_to_route('admin.management.inventory.asset.deleted', trans('menus.backend.management.inventory.asset.deleted')) }}</li>
      </ul>
   </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
