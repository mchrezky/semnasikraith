<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Exception;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Table\EventList;
use App\Models\Table\EventType;
use App\Models\Table\MsSemnas;

class EventListController extends Controller
{

    public function index()
    {
        $eventList = EventList::select('event_list.*', 'event_type.nama as type_name', 'ms_semnas.name as semnas_name')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->join('ms_semnas', 'event_list.semnas_id', '=', 'ms_semnas.id')
            ->where('event_list.status', '1')
            ->get();

        $eventType = EventType::where('is_deleted', false)->get();
        $msSemnas = MsSemnas::where('status', 1)->get();

        $data = [
            'eventList' => $eventList,
            'eventType' => $eventType,
            'msSemnas' => $msSemnas
        ];

        return view('be-semnas.master-event-list')->with('data', $data);
    }

    public function create(Request $request)
    {
        try {

            $file = $request->file('file_event_list');

            $extension = $file->getClientOriginalExtension();

            $filePathName = Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_event_list.' . $extension;

            $file->storeAs('public/file_event_list', $filePathName);

            $data = [
                'id_type' => $request->id_type,
                'semnas_id' => $request->semnas_id,
                'nama' => $request->nama,
                'harga' => $request->harga,
                'foto' => $filePathName,
                'ket' => $request->ket,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ];

            $create = EventList::create($data);

            if ($create) {
                return redirect('/master-event-list')->with('success', 'Data created successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to create data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {

            if ($request->file('file_event_list') != null) {
                $file = $request->file('file_event_list');

                $extension = $file->getClientOriginalExtension();

                $filePathName = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_event_list.' . $extension;

                $file->storeAs('public/file_event_list', $filePathName);

                $data = [
                    'id_type' => $request->id_type,
                    'semnas_id' => $request->semnas_id,
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'foto' => $filePathName,
                    'ket' => $request->ket,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                ];
            } else {
                $data = [
                    'id_type' => $request->id_type,
                    'semnas_id' => $request->semnas_id,
                    'nama' => $request->nama,
                    'harga' => $request->harga,
                    'ket' => $request->ket,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                ];
            }

            $eventList = EventList::findOrFail($request->id);
            $update = $eventList->update($data);

            if ($update) {
                return redirect('/master-event-list')->with('success', 'Data updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = [
                'status' => 0,
            ];

            $eventList = EventList::findOrFail($request->id);
            $update = $eventList->update($data);

            if ($update) {
                return redirect('/master-event-list')->with('success', 'Data deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }
}
