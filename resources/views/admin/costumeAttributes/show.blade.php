@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.costumeAttribute.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.costume-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.costumeAttribute.fields.id') }}
                        </th>
                        <td>
                            {{ $costumeAttribute->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.costumeAttribute.fields.title') }}
                        </th>
                        <td>
                            {{ $costumeAttribute->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.costumeAttribute.fields.values') }}
                        </th>
                        <td>
                            {{ $costumeAttribute->values }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.costume-attributes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
