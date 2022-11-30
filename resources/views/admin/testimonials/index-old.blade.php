@extends('layouts.admin')
@section('content')
    @can('testimonial_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.testimonials.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.testimonial.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.testimonial.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive overflow-visible print">
                <table class="table table-sm table-hover table-wrap card-table" id="data-table">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.review_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.ratings') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.lastname') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.event_trip_booking') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.review_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.featured') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($testimonials as $key => $testimonial)
                        <tr data-entry-id="{{ $testimonial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $testimonial->id ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->review_text ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->ratings ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->user->lastname ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->event_trip_booking->booking_details ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->review_date ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $testimonial->featured ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $testimonial->featured ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('testimonial_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.testimonials.show', $testimonial->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('testimonial_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.testimonials.edit', $testimonial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('testimonial_delete')
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('testimonial_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.testimonials.massDestroy') }}",
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
            let table = $('.datatable-Testimonial:not(.ajaxTable)');
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection<?php
