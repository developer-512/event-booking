<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\City;
use App\Models\Costume;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventAddon;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\State;
use App\Models\Testimonial;
use App\Models\TripDateRange;
use Carbon\CarbonPeriod;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use JetBrains\PhpStorm\Pure;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    private $request;
    use MediaUploadingTrait;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::with(['country', 'state', 'city', 'media'])->get();

        return view('front.trips.trips', compact('events'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.events.create', compact('cities', 'countries', 'states'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());

        if ($request->input('featured_image', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('frontend.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $states = State::pluck('state_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('city_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event->load('country', 'state', 'city');

        return view('frontend.events.edit', compact('cities', 'countries', 'event', 'states'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

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

        return redirect()->route('frontend.events.index');
    }

    public function show(Event $event)
    {
        //abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('country', 'state', 'city');

        return view('front.trips.trip-event', compact('event'));
    }
    public function customized_trip($trip_title,Event $trip){
//       dd($trip_title,$trip);
        $data['travelers']=1;
        if($this->request->travelers>0){
            $data['travelers']=$this->request->travelers;
        }
        $data['page_name']=$trip_title;
//        $data['page_type']='trip';
        $trip->load('country', 'state', 'city');
        $data['trip']=$trip;
        $data['countries']=$countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $period = CarbonPeriod::create(date('Y-m-d H:i:s',strtotime($trip->event_start)), date('Y-m-d H:i:s',strtotime($trip->event_end)));
        // Iterate over the period
        $dates=$period->toArray();
//        foreach ($period as $date) {
//
//        }
        foreach ($dates as $i=> $date){
            $dates[$i]=date('d-M-Y',strtotime($date));
        }

//        echo json_encode($pieces);exit;
        if($trip->duration>2){
            list($date_range_1, $date_range_2) = array_chunk($dates, ceil(count($dates) / 2));
            $data['range'][0]['date']=Arr::first($date_range_1).' > '.Arr::last($date_range_1);
            $data['range'][0]['duration']=count($date_range_1);
            $data['range'][0]['price']=($trip->daily_price*count($date_range_1))*$data['travelers'];
        }
        $range_low_price=0;
        if(count($trip->date_ranges)<=0&&count($trip->room_pricing)<=0){
            Session::flush();
            Session::flash('error','Booking for this Event is Not Available');
            return redirect()->route('frontend.trip_view',['trip_title'=>str_replace(' ','-',$trip->event_title),'event'=>$trip->id]);
        }

        if(count($trip->date_ranges)<=0){
            $prr_array=$price_array=[];
            foreach ($trip->room_pricing as $r_pricing_range){
                $p=$r_pricing_range->room_pricing()->orderBy('price', 'asc')->first();
                $prr_array[]=[
                'event_id'=>$trip->id,
                    'range_start'=>$r_pricing_range->start_date,
                    'range_end'=>$r_pricing_range->end_date,
                    'range_title'=>'',
                    'range_price'=>$p->price,
                ];
                $price_array[]=$p->price;
//
            }

            if(count($prr_array)>0){
                foreach ($prr_array as $p_range_trip){
                    if(max($price_array)==$p_range_trip['range_price']){
                        $p_range_trip['range_title']='Premium';
                    }else{
                        $p_range_trip['range_title']='Basic';
                    }
                    TripDateRange::create($p_range_trip);
                }



            }
//            dd([$trip->room_pricing,$prr_array]);
        }
//        dd(count($trip->date_ranges)<=0);
        if($trip->date_ranges()->orderBy('range_price', 'asc')->first()){
            $range_low_price=$trip->date_ranges()->orderBy('range_price', 'asc')->first()->range_price;
        }
        $room_prices=[];

        foreach ($trip->date_ranges as $date_range){
            foreach ($trip->hotels as $hotel){
                foreach ($hotel->rooms as $room){
                    if($hotel->id==2) {
                        $room_prices[$date_range->id][$room->id]=get_room_price($trip,$room->id,$data['travelers'],$date_range->range_start,$date_range->range_end,'no_accommodation');
                    }else {
                        if (room_capacity_to_traveler($room->room_capacity, $data['travelers'])){
                            $room_prices[$date_range->id][$room->id] = get_room_price($trip, $room->id, $data['travelers'], $date_range->range_start, $date_range->range_end, '');
                        }
                    }
                }
            }
        }
//dd($room_prices);
        $data['low_total']=$range_low_price;
        $data['low_deposit']=$range_low_price>0?($range_low_price*((float)DEPOSIT_AMOUNT_PERCENT/100)):0;
        $installment=$range_low_price-$data['low_deposit'];
        $data['low_installment']=$range_low_price>0?($installment/(int)TOTAL_INSTALLMENTS):0;

        $data['room_prices']=$room_prices;
        $data['total_event_tickets']=count($trip->tickets);
        $data['range'][1]['date']=date('d-M-Y',strtotime($trip->event_start)).' > '.date('d-M-Y',strtotime($trip->event_end));
        $data['range'][1]['duration']=count($dates);
        $data['range'][1]['price']=($trip->daily_price*$trip->duration)*$data['travelers'];
        $data['intent'] = auth()->user()->createSetupIntent();
        $paymentMethods = Auth::user()->paymentMethods()->map(function($paymentMethod){
            return $paymentMethod->asStripePaymentMethod();
        });
        $data['payment_method']=(count($paymentMethods)>0?$paymentMethods:'');
        $data['no_accommodation']=Hotel::find(2);
//        echo $data['payment_method']->id;
//        dd($data['payment_method']);
        //var_dump($data = $this->request->session()->all());
        return view('front.trips.custom_trip',$data);
    }

    public function trip_view($trip_title,Event $event)
    {
        //abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['page_name']=$trip_title;
        $data['page_type']='trip';
        $event->load('country', 'state', 'city');

//        $data['reviews']=Testimonial::where('')
        $reviews=array();
        $ratings_=[];
        foreach ($event->bookingEventEventBookings as $books){
            foreach ($books->booking_reviews as $rev){
                $reviews[]=$rev;
                $ratings_[]=$rev->ratings;
            }
        }
//        dd($reviews);
        $total_reviews=count($reviews);
        $ratings_count=[];
        for ($rc=1;$rc<=5;$rc++){$ratings_count[$rc]=[];$ratings_count[$rc]['count']=0;$ratings_count[$rc]['percent']=0;}
            if($total_reviews>0){
            foreach ($reviews as $review){
                $ratings_count[$review->ratings]['count']+=1;
            }
            foreach ($ratings_count as $ratings => $count){
                $ratings_count[$ratings]['percent']=($count['count']/$total_reviews)*100;
            }
        }
        $data['ratings_percent']=array_reverse($ratings_count,true);
$data['reviews']=$reviews;
$data['avg_ratings']=0;
        $ratings_ = array_filter($ratings_);
        if(count($ratings_)) {
            $data['avg_ratings'] = array_sum($ratings_)/count($ratings_);
        }
//echo $reviews->avg('ratings');
        $data['trip']=$event;
        $data['featured_trips']=$events=Event::where('event_end','>',date('Y-m-d'))
            ->orderBy('event_start','asc')->limit(10)->get();
        $ratings_=$avg_ratings=$range=[];
        foreach ($events as $event_){
            $event_range=$event_->date_ranges()->orderBy('range_end', 'desc')->first();
            $ratings_=[];
            foreach ($event_->bookingEventEventBookings as $books){
                foreach ($books->booking_reviews as $rev){
                    $ratings_[]=$rev->ratings;
                }
            }
            $avg_ratings[$event_->id]=0;
            $ratings_ = array_filter($ratings_);
            if(count($ratings_)>0) {
                $avg_ratings[$event_->id] = array_sum($ratings_)/count($ratings_);
            }
            if($event_range){
                $range[$event_->id]=date('M d',strtotime($event_range->range_start)).'- '.date('d',strtotime($event_range->range_end));
            }else{
                $range[$event_->id]=date('M d',strtotime($event_->event_start)).'- '.date('d',strtotime($event_->event_end));
            }
        }
        $data['avg_ratings_events']=$avg_ratings;
        $data['ranges']=$range;
//        dd($reviews,array_reverse($ratings_count,true));
        return view('front.trips.trip-event', $data);
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
