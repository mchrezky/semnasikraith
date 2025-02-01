<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Table\Event;
use App\Models\Table\EventList;
use Exception;

class EventController extends Controller
{

    public function index()
    {

        $event = EventList::select('event_list.*', 'event_type.nama as type_name')->where('event_list.status', '1')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->paginate(6);

        $data = [
            'event' => $event
        ];

        return view('fe-semnas.events')->with('data', $data);
    }

    public function createEventView($id_event)
    {
        $event = EventList::select('event_list.*', 'event_type.nama as type_name')->where('event_list.status', '1')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->where('event_list.id', $id_event)
            ->first();

        return view('fe-semnas.create-event')->with('data', $event);
    }

    public function createEvent(Request $request)
    {
        try {
            $generatedId = $this->idOtomatis();

            $file = $request->file('file_hasil_cek_turnitin');

            $filePathName = str_replace('/', '_', $generatedId) . '_file_hasil_cek_turnitin.pdf';

            $filePath = $file->storeAs('public/file_turnitin', $filePathName);

            $data = [
                'id' => $generatedId,
                'id_user' => Auth::user()->id,
                'event_list' => $request->event_list,
                'seminar_name' => $request->seminar_name,
                'title' => $request->title,
                'writer1' => $request->writer1,
                'email1' => $request->email1,
                'writer2' => $request->writer2,
                'email2' => $request->email2,
                'writer3' => $request->writer3,
                'email3' => $request->email3,
                'writer4' => $request->writer4,
                'email4' => $request->email4,
                'writer5' => $request->writer5,
                'email5' => $request->email5,
                'writer6' => $request->writer6,
                'email6' => $request->email6,
                'writer7' => $request->writer7,
                'email7' => $request->email7,
                'hasil_cek_turnitin' => $filePathName,
                'file_hasil_cek_turnitin' => $filePath,
                'date' => date('Y-m-d'),
                'order_id' => $this->orderIdOtomatis(),
            ];

            $create = Event::create($data);

            if ($create) {
                return redirect('/')->with('success', 'Submit data successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    function idOtomatis()
    {
        $lastEvent = Event::latest()->first();
        $lastId = $lastEvent ? (int) explode('/', $lastEvent->id)[0] : 0;

        $newId = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        $seminarName = strtoupper(request()->seminar_name);
        $eventList = request()->event_list;
        $userId = Auth::user()->id;
        $currentDate = date('Y-m-d');

        $id = "{$newId}/{$eventList}/{$userId}/{$currentDate}";

        return $id;
    }

    function orderIdOtomatis()
    {
        $lastEvent = Event::latest()->first();
        $lastId = $lastEvent ? (int) explode('/', $lastEvent->id)[0] : 0;

        $newId = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        $seminarName = strtoupper(request()->seminar_name);
        $eventList = request()->event_list;
        $userId = Auth::user()->id;
        $currentDate = date('Y-m-d');

        $id = "#INV-{$newId}-{$eventList}-{$userId}-{$currentDate}";

        return $id;
    }
}
