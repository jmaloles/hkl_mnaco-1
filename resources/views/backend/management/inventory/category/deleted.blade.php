@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.inventory.category.title'))

@section('after-styles')
{{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
   {{ trans('labels.backend.management.inventory.category.title') }}
   <small>{{ trans('labels.backend.management.inventory.category.deleted') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.inventory.category.deleted') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.inventory.category.includes.partials.category-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="table-responsive">
         <table id="categories-table" class="table table-condensed table-hover">
            <thead>
               <tr>
                  <th>{{ trans('labels.backend.management.inventory.category.table.name') }}</th>
                  <th>{{ trans('labels.backend.management.inventory.category.table.created_at') }}</th>
                  <th>{{ trans('labels.backend.management.inventory.category.table.updated_at') }}</th>
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
   $('#categories-table').DataTable({
      dom: 'lfrtip',
      processing: true,
      serverSide: true,
      autoWidth: false,
      ajax: {
         url: '{{ route("admin.management.inventory.category.get") }}',
         type: 'post',
         data: {trashed: true},
         error: function (xhr, err) {
            if (err === 'parsererror')
            location.reload();
         }
      },
      columns: [
         {data: 'name',              name: '{{config('management.inventory.categories_table')}}.name'},
         {data: 'created_at',        name: '{{config('management.inventory.categories_table')}}.created_at'},
         {data: 'updated_at',        name: '{{config('management.inventory.categories_table')}}.updated_at'},
         {data: 'actions',           name: 'actions', searchable: false, sortable: false}
      ],
      order: [[0, "asc"]],
      searchDelay: 500
   });
});
</script>
@endsection
