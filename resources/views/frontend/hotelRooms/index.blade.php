@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('hotel_room_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.hotel-rooms.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.hotelRoom.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.hotelRoom.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-HotelRoom">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.hotelRoom.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hotelRoom.fields.hotel') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hotelRoom.fields.room_title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hotelRoom.fields.room_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.hotelRoom.fields.room_quantity') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hotelRooms as $key => $hotelRoom)
                                    <tr data-entry-id="{{ $hotelRoom->id }}">
                                        <td>
                                            {{ $hotelRoom->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hotelRoom->hotel->hotel_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hotelRoom->room_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hotelRoom->room_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $hotelRoom->room_quantity ?? '' }}
                                        </td>
                                        <td>
                                            @can('hotel_room_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.hotel-rooms.show', $hotelRoom->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('hotel_room_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.hotel-rooms.edit', $hotelRoom->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('hotel_room_delete')
                                                <form action="{{ route('frontend.hotel-rooms.destroy', $hotelRoom->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('hotel_room_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.hotel-rooms.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  });
  let table = $('.datatable-HotelRoom:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection