<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist\Event;

class EventTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        $results = Event::whereHas('tags', function ($q) use($tag) {
            $q->where('name', $tag);
        })->orderBy('start_at', 'ASC')->get();
        // $events = EventTag::where('name', $tag)->events()->get();
        return view('public.event.tag.show')->withResults($results);
    }
}
