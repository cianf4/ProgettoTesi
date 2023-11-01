<?php

namespace App\Http\Controllers;

use App\Models\SingleEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SingleEventController extends Controller
{
    public function index()
    {
        $single_events = SingleEvent::all();

        return view('single_events.index',['single_events'=>$single_events]);
    }
    public function create()
    {
        $users = User::where('approved', true)
            ->where('is_admin', false)
            ->orderBy('name', 'asc')
            ->get();
        return view('single_events.create',['users'=> $users]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'type' => 'nullable|string',
        ]);

        $event = new SingleEvent();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->date = Carbon::parse($request->input('date'))->format('Y-m-d H:i:s');
        $event->type = $request->input('type');
        $event->user_id = $request["user"];
        $event->save();

        return redirect()->route('singlecall.index')
            ->with('success', 'Evento creato con successo');
    }
    public function show( $singlecall)
    {

        $chiamata = SingleEvent::find($singlecall);
        return view('single_events.show', [ 'singlecall' => $chiamata]);
    }

}
