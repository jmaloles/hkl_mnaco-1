@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.inventory.category.title'))

@section('after-styles')
{{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
   {{ trans('labels.backend.management.inventory.category.title') }}
   <small>{{ trans('labels.backend.management.inventory.category.view', ['category' => $category->name]) }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.inventory.category.view', ['category' => $category->name]) }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.inventory.category.includes.partials.category-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="table-responsive">
         <table id="assets-table" class="table table-condensed table-hover">
            <thead>
               <tr>
                  <th>{{ trans('labels.backend.management.inventory.asset.table.name') }}</th>
                  <th>{{ trans('labels.backend.management.inventory.asset.table.serial_number') }}</th>
                  <th>{{ trans('labels.backend.management.inventory.asset.table.eas_tag') }}</th>
                  <th>{{ trans('labels.backend.management.inventory.asset.table.status') }}</th>
                  <th>{{ trans('labels.backend.management.inventory.asset.table.created_at') }}</th>
                  <th>{{ trans('labels.backend.management.inventory.asset.table.updated_at') }}</th>
                  <th>{{ trans('labels.general.actions') }}</th>
               </tr>
            </thead>
         </table>
      </div><!--table-responsive-->
   </div><!-- /.box-body -->
</div><!--box-->

<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
      <div class="box-tools pull-right">
         <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div><!-- /.box tools -->
   </div><!-- /.box-header -->
   <div class="box-body">
      {!! history()->renderType('Category') !!}
   </div><!-- /.box-body -->
</div><!--box box-success-->
@endsection

@section('after-scripts')
{{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

<script>
$(function () {
   $('#assets-table').DataTable({
      dom: 'lfrtip',
      processing: false,
      serverSide: true,
      autoWidth: false,
      ajax: {
         url: '{{ route("admin.management.inventory.asset.get") }}',
         type: 'post',
         data: {status: 1, trashed: false, category_type: '{{ $category->id }}'},
         error: function (xhr, err) {
            if (err === 'parsererror')
            location.reload();
         }
      },
      columns: [
         {data: 'name',          name: '{{config('management.inventory.assets_table')}}.name'},
         {data: 'serial_number', name: '{{config('management.inventory.assets_table')}}.serial_number'},
         {data: 'eas_tag',       name: '{{config('management.inventory.assets_table')}}.eas_tag'},
         {data: 'status',        name: '{{config('management.inventory.assets_table')}}.status'},
         {data: 'created_at',    name: '{{config('management.inventory.assets_table')}}.created_at'},
         {data: 'updated_at',    name: '{{config('management.inventory.assets_table')}}.updated_at'},
         {data: 'actions',       name: 'actions', searchable: false, sortable: false}
      ],
      order: [[0, "asc"]],
      searchDelay: 500
   });
});
</script>
@endsection