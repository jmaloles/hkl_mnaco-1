@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.inventory.asset.title') . ' | ' . trans('labels.backend.management.inventory.asset.create'))

@section('page-header')
<h1>
   {{ trans('labels.backend.management.inventory.asset.title') }}
   <small>{{ trans('labels.backend.management.inventory.asset.create') }}</small>
</h1>
@endsection

@section('content')
{{ Form::open(['route' => 'admin.management.inventory.asset.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.inventory.asset.create') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.inventory.asset.includes.partials.asset-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="form-group">
         {{ Form::label('name', trans('validation.attributes.backend.management.inventory.asset.name'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.management.inventory.asset.name')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('serial_number', trans('validation.attributes.backend.management.inventory.asset.serial_number'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('serial_number', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.inventory.asset.serial_number')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('eas_tag', trans('validation.attributes.backend.management.inventory.asset.eas_tag'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('eas_tag', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.inventory.asset.eas_tag')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('category', trans('validation.attributes.backend.management.inventory.asset.category'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('category', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.management.inventory.asset.category')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('status', trans('validation.attributes.backend.management.inventory.asset.active'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-1">
            {{ Form::checkbox('status', '1', true, ['style' => 'margin: 12px 0 0;']) }}
         </div><!--col-lg-1-->
      </div><!--form control-->
   </div><!--box-->

   <div class="box box-info">
      <div class="box-body">
         <div class="pull-left">
            {{ link_to_route('admin.management.inventory.asset.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
         </div><!--pull-left-->

         <div class="pull-right">
            {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
         </div><!--pull-right-->

         <div class="clearfix"></div>
      </div><!-- /.box-body -->
   </div><!--box-->

   {{ Form::close() }}
   @endsection

   @section('after-scripts')
   {{ Html::script('js/backend/access/users/script.js') }}
   @endsection
