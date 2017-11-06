<table class="table table-striped table-hover">
   <tr>
      <th>{{ trans('labels.backend.management.inventory.asset.tabs.content.overview.name') }}</th>
      <td>{{ $asset->name }}</td>
   </tr>

   <tr>
      <th>{{ trans('labels.backend.management.inventory.asset.tabs.content.overview.serial_number') }}</th>
      <td>{{ $asset->serial_number }}</td>
   </tr>

   <tr>
      <th>{{ trans('labels.backend.management.inventory.asset.tabs.content.overview.eas_tag') }}</th>
      <td>{{ $asset->eas_tag }}</td>
   </tr>

   <tr>
      <th>{{ trans('labels.backend.management.inventory.asset.tabs.content.overview.status') }}</th>
      <td>{!! $asset->status_label !!}</td>
   </tr>

   <tr>
      <th>{{ trans('labels.backend.management.inventory.asset.tabs.content.overview.created_at') }}</th>
      <td>{{ $asset->created_at }} ({{ $asset->created_at->diffForHumans() }})</td>
   </tr>

   <tr>
      <th>{{ trans('labels.backend.management.inventory.asset.tabs.content.overview.updated_at') }}</th>
      <td>{{ $asset->updated_at }} ({{ $asset->updated_at->diffForHumans() }})</td>
   </tr>

   @if ($asset->trashed())
   <tr>
      <th>{{ trans('labels.backend.management.inventory.asset.tabs.content.overview.deleted_at') }}</th>
      <td>{{ $asset->deleted_at }} ({{ $asset->deleted_at->diffForHumans() }})</td>
   </tr>
   @endif
</table>
