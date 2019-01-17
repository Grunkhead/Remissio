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
        return view('appointments/edit', [
            'event' => Event::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $event = Event::find($id);
        $event->name = $request->name;
        $event->description = $request->description;
        // TODO write all form properties.
        $event->save();

        return redirect()->action('AppointmentController@index');
    }

    public function destroy($id)
    {
        Event::find($id)->delete();
        return redirect()->action('AppointmentController@index');
    }


    private function typecastToCarbon($date) {
        return Carbon::parse($date);
    }

    private function formatDateTime ($dateTime) {
        return $dateTime->format('d F Y - H:i');
    }
}
