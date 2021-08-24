<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventFormRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::with('details')->latest()->first();

        return Inertia::render('Welcome', [
            'event' => $event
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EventFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventFormRequest $request)
    {
        $event = Event::create($request->validated());

        $range = Carbon::parse($request->from)->toPeriod($request->to);

        collect($range)
            ->filter(fn ($date) => in_array($date->shortEnglishDayOfWeek, $request->days))
            ->each(fn ($date) => $event->details()->create(['date' => $date->format('Y-m-d')]));

        session()->flash('flash.banner', 'Event has been created');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('events.index');
    }
}
