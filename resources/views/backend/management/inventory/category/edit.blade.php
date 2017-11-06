@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.inventory.category.title') . ' | ' . trans('labels.backend.management.inventory.category.edit'))

@section('page-header')
<h1>
   {{ trans('labels.backend.management.inventory.category.title') }}
   <small>{{ trans('labels.backend.management.inventory.category.edit') }}</small>
</h1>
@endsection

@section('content')
   {{ Form::model($category, ['route' => ['admin.management.inventory.category.update', $category], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}

   <div class="box box-success">
      <div class="box-header with-border">
         <h3 class="box-title">{{ trans('labels.backend.management.inventory.category.edit') }}</h3>

         <div class="box-tools pull-right">
            @include('backend.management.inventory.category.includes.partials.category-header-buttons')
         </div><!--box-tools pull-right-->
      </div><!-- /.box-header -->

      <div class="box-body">
         <div class="form-group">
            {{ Form::label('name', trans('validation.attributes.backend.management.inventory.category.name'), ['class' => 'col-lg-2 control-label']) }}

            <div class="col-lg-10">
               {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '30', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.management.inventory.category.name')]) }}
            </div><!--col-lg-10-->
         </div><!--form control-->
      </div><!-- /.box-body -->
   </div><!--box-->

   <div class="box box-success">
      <div class="box-body">
         <div class="pull-left">
            {{ link_to_route('admin.management.inventory.category.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
         </div><!--pull-left-->

         <div class="pull-right">
            {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
         </div><!--pull-right-->

         <div class="clearfix"></div>
      </div><!-- /.box-body -->
   </div><!--box-->

   {{ Form::close() }}
@endsection

@section('after-scripts')
   {{ Html::script('js/backend/access/users/script.js') }}
@endsection
