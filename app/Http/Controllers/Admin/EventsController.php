<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventAddon;
use App\Models\Hotel;
use App\Models\PackageAmenity;
use App\Models\State;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::with(['country', 'state', 'city', 'hotels', 'addons', 'amenities_includeds', 'media'])->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hotels = Hotel::pluck('hotel_name', 'id');

        $addons = EventAddon::pluck('addon_title', 'id');

        $amenities_includeds = PackageAmenity::pluck('title', 'id');

        return view('admin.events.create', compact('addons', 'amenities_includeds', 'cities', 'countries', 'hotels', 'states'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $event->hotels()->sync($request->input('hotels', []));
        $event->addons()->sync($request->input('addons', []));
        $event->amenities_includeds()->sync($request->input('amenities_includeds', []));
        if ($request->input('featured_image', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hotels = Hotel::pluck('hotel_name', 'id');

        $addons = EventAddon::pluck('addon_title', 'id');

        $amenities_includeds = PackageAmenity::pluck('title', 'id');

        $event->load('country', 'state', 'city', 'hotels', 'addons', 'amenities_includeds');

        return view('admin.events.edit', compact('addons', 'amenities_includeds', 'cities', 'countries', 'event', 'hotels', 'states'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->hotels()->sync($request->input('hotels', []));
        $event->addons()->sync($request->input('addons', []));
        $event->amenities_includeds()->sync($request->input('amenities_includeds', []));
        if ($request->input('featured_image', false)) {
            if (!$event->featured_image || $request->input('featured_image') !== $event->featured_image->file_name) {
                if ($event->featured_image) {
                    $event->featured_image->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($event->featured_image) {
            $event->featured_image->delete();
        }

        return redirect()->route('admin.events.index');
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('country', 'state', 'city', 'hotels', 'addons', 'amenities_includeds', 'bookingEventEventBookings');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
