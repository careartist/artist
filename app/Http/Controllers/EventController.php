<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist\Event;
use App\Models\Artist\EventTag;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = EventTag::has('events')->get();
        $events = Event::where('start_at', '>', \Carbon\Carbon::now())
                        ->orWhere('end_at', '>', \Carbon\Carbon::now())
                        ->orderBy('start_at', 'ASC')
                        ->get();
        return view('public.event.index')->withEvents($events)->withTags($tags);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = EventTag::has('events')->get();
        $event = Event::find($id);
        if(!$event)
            return redirect()->route('public.events');

        return view('public.event.show')->withEvent($event)->withTags($tags);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function showTags($tag)
    {
        $tags = EventTag::has('events')->get();
        $results = Event::whereHas('tags', function ($q) use($tag) {
            $q->where('name', $tag);
        })->orderBy('start_at', 'ASC')->get();
        return view('public.event.tag.show')->withResults($results)->withTags($tags);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function showTypes($type)
    {
        $tags = EventTag::has('events')->get();
        $results = Event::where('type', $type)->orderBy('start_at', 'ASC')->get();
        return view('public.event.type.show')->withResults($results)->withTags($tags);
    }
    
}
