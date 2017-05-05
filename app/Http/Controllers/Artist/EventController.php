<?php

namespace App\Http\Controllers\Artist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User\Ucare;
use App\Models\Artist\EventType;
use App\Models\Artist\Event;
use App\Models\Artist\EventTag;
use App\Models\User\Region;
use App\Models\User\PlacePivot;
use App\Models\User\Place;
use Sentinel;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('artist');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('artist.events.index')->withUser(Sentinel::getUser());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $cities = Region::find(10)->places()->get();
        // dd($cities);

        $regions = Region::orderBy('place', 'asc')->get();
        return view('artist.events.create')
                ->withEventTypes(EventType::get())
                ->withTags(EventTag::get())
                ->withRegions($regions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validator($request->all())->validate();

        $id_tags=array();
        foreach ($request->tags as $tag) {
            $result = EventTag::where('name', $tag)->first();
            if(count($result) > 0)
            {
                $id_tags[] = $result->id;
            }
            else
            {
                $newtag = new EventTag;
                $newtag->name = $tag;
                $newtag->save();
                $id_tags[] = $newtag->id;
            }
        }

        $user = Sentinel::getUser();

        $event = Event::create([
            'title'         => $request['title'],
            'description'   => $request['description'],
            'type'          => $request['event_type'],
            'price'         => $request['event_price'],
            'start_at'      => $request['start_at'],
            'end_at'        => $request['end_at'],
            'contact_name'  => $request['contact_name'],
            'contact_email' => $request['contact_email'],
            'contact_phone' => $request['contact_phone'],
            'region_id'     => $request['region'],
            'place_id'      => $request['place'],
            'profile_id'    => $user->profile->artist_profile->id
        ]);

        $event->tags()->sync($id_tags);

        return redirect()->route('events.show', ['event' => $event->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ucare = Ucare::getLowestUploads();
        $user = Sentinel::getUser();
        $user->ucare_id = $ucare->id;
        $user->save();

        $profile_artist = Sentinel::getUser()->profile->artist_profile;
        $event = Event::where(['id' => $id, 'profile_id' => $profile_artist->id])->first();

        if(!$event)
        {
            return redirect()->route('events.index');
        }
        
        return view('artist.events.show')
                ->withEvent($event)
                ->withUcare($ucare);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile_artist = Sentinel::getUser()->profile->artist_profile;
        $event = Event::where(['id' => $id, 'profile_id' => $profile_artist->id])->first();

        if(!$event)
        {
            return redirect()->route('events.index');
        }

        $regions = Region::select('id', 'place')->orderBy('place', 'asc')->get();
        $places = $this->ajaxCities($event->region_id);

        return view('artist.events.edit')
                ->withEventTypes(EventType::get())
                ->withTags(EventTag::get())
                ->withEvent($event)
                ->withRegions($regions)
                ->withPlaces($places);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profile_artist = Sentinel::getUser()->profile->artist_profile;
        $event = Event::where(['id' => $id, 'profile_id' => $profile_artist->id])->first();

        if(!$event)
        {
            return redirect()->route('events.index');
        }

        $validation = $this->validator($request->all())->validate();

        if($validation)
        {
            return $validation;
        }

        $event->title           = $request['title'];
        $event->description     = $request['description'];
        $event->type            = $request['event_type'];
        $event->price           = $request['event_price'];
        $event->start_at        = $request['start_at'];
        $event->end_at          = $request['end_at'];
        $event->contact_name    = $request['contact_name'];
        $event->contact_email   = $request['contact_email'];
        $event->contact_phone   = $request['contact_phone'];
        $event->region_id       = $request['region'];
        $event->place_id        = $request['place'];
        $event->save();

        $id_tags = array();
        $tags = $request->input('tags', []);
        foreach ($tags as $tag) {

            $result = EventTag::where('name', $tag)->first();

            if(count($result) > 0)
            {
                $id_tags[] = $result->id;
            }
            else
            {
                $newtag = new EventTag;
                $newtag->name = $tag;
                $newtag->save();
                $id_tags[] = $newtag->id;
            }
        }
        // $tags = $id_tags ? $id_tags : [];
        $event->tags()->sync($id_tags, true);

        return redirect()->route('events.show', ['event' => $event->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile_artist = Sentinel::getUser()->profile->artist_profile;
        $event = Event::where(['id' => $id, 'profile_id' => $profile_artist->id])->first();

        if(!$event)
        {
            return redirect()->route('events.index');
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:2000',
            'event_type' => 'required|string|max:50',
            'event_price' => 'required|string|max:50',
            'start_at' => 'required|date|max:25',
            'end_at' => 'nullable|date|after:start_at',
            'contact_name' => 'nullable|string|max:50',
            'contact_email' => 'nullable|string|email|max:190|required_with:contact_name',
            'contact_phone' => 'nullable|string|max:20|required_with:contact_name',
            'tags' => 'required|array',
            'region' => 'required|string|max:100',
            'place' => 'required|string|max:100',
        ]);
    }

    public function ajaxCities($region_id)
    {
        return $regions = Place::select('places.id', 'places.place', 'c.id as p_id', 'c.place as p_place')
                        ->leftJoin('places_ref as c', 'c.id', '=', 'places.sirsup')
                        ->whereIn('places.sirsup', PlacePivot::select('places_ref.id')
                            ->where('places_ref.sirsup', $region_id)
                            ->get()
                        )
                        ->orderBy('places.fsl', 'asc')->get();
    }
}
