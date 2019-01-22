<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::get();

        foreach ($events as $event) {
            $event->start->dateTime = $this->formatDateTime(
                $this->typecastToCarbon($event->start->dateTime));
        }

        return view('appointments/index', [
            'events' => $events
        ]);
    }

    public function new()
    {
        return view('appointments/new', [
            'event' => new Event
        ]);
    }

    public function create(Request $request)
    {
        $carbonDateTime = $this->typecastToCarbon($request->start_datetime);
        $carbonDateTime = $carbonDateTime->subHours(2);

        Event::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'startDateTime' => $carbonDateTime,
            'endDateTime'   => $carbonDateTime->addHour(),
        ]);

        return redirect()->action('AppointmentController@index');
    }

    public function edit($id)
    {
        $event = Event::find($id);
        $event->start->dateTime = $this->formatDateTime(
                $this->typecastToCarbon($event->start->dateTime));

        return view('appointments/edit', [
            'event' => $event
        ]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        $carbonDateTime = $this->typecastToCarbon($request->start_datetime);
        $carbonDateTime = $carbonDateTime->subHours(2);

        $event->update([
            'name'          => $request->name,
            'description'   => $request->description,
            'startDateTime' => $carbonDateTime,
            'endDateTime'   => $carbonDateTime->addHour(),
        ]);

        return redirect()->action('AppointmentController@index');
    }

    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->action('AppointmentController@index');
    }


    static function typecastToCarbon($time) {
        return Carbon::parse($time);
    }

    static function formatDateTime ($dateTime) {
        return $dateTime->format('d-m-Y H:i');
    }
}
