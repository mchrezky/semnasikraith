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
use App\Models\Table\EventType;

class EventTypeController extends Controller
{

    public function index()
    {
        $eventType = EventType::where('is_deleted', false)->get();

        $data = [
            'eventType' => $eventType
        ];

        return view('be-semnas.master-event-type')->with('data', $data);
    }

    public function create(Request $request)
    {
        try {

            $data = [
                'nama' => $request->nama,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            $create = EventType::create($data);

            if ($create) {
                return redirect('/master-event-type')->with('success', 'Data created successfully.');
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
            $data = [
                'nama' => $request->nama,
                'updated_by' => Auth::user()->id,
            ];

            $eventType = EventType::findOrFail($request->id);
            $update = $eventType->update($data);

            if ($update) {
                return redirect('/master-event-type')->with('success', 'Data updated successfully.');
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
                'is_deleted' => true,
                'updated_by' => Auth::user()->id,
            ];

            $eventType = EventType::findOrFail($request->id);
            $update = $eventType->update($data);

            if ($update) {
                return redirect('/master-event-type')->with('success', 'Data deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }
}
