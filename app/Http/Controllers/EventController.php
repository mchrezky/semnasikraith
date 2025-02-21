<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Table\Event;
use App\Models\Table\EventNon;
use App\Models\Table\EventList;
use App\Models\Table\Categories;
use Exception;

class EventController extends Controller
{

    public function index()
    {

        $event = EventList::select('event_list.*', 'event_type.nama as type_name', 'ms_semnas.name as semnas_name')->where('event_list.status', '1')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->join('ms_semnas', 'event_list.semnas_id', '=', 'ms_semnas.id')
            ->paginate(6);

        $data = [
            'event' => $event
        ];

        return view('fe-semnas.events')->with('data', $data);
    }
    public function events()
    {

        $event = Event::select('event.*', 'event_list.nama', 'event_type.nama as type_name', 'ms_semnas.name as semnas_name')->where('event_list.status', '1')
            ->where('id_user', Auth::user()->id)
            ->join('event_list', 'event_list.id', '=', 'event.event_list')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->join('ms_semnas', 'event_list.semnas_id', '=', 'ms_semnas.id')
            ->orderBy('id', 'asc')->get();
        $eventnon = EventNon::select('event_non.*', 'event_list.nama', 'event_type.nama as type_name', 'ms_semnas.name as semnas_name')->where('event_list.status', '1')
            ->where('id_user', Auth::user()->id)
            ->join('event_list', 'event_list.id', '=', 'event_non.event_list')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->join('ms_semnas', 'event_list.semnas_id', '=', 'ms_semnas.id')
            ->orderBy('id', 'asc')->get();
        $data = [
            'event' => $event,
            'eventnon' => $eventnon
        ];

        return view('fe-semnas.data-events')->with('data', $data);
    }

    public function createEventView($id_event)
    {
        $event = EventList::select('event_list.*', 'event_type.nama as type_name')->where('event_list.status', '1')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->where('event_list.id', $id_event)
            ->first();

        $categories = Categories::all();

        $data = [
            'event' => $event,
            'categories' => $categories
        ];

        if ($event->id_type == 1) {
            return view('fe-semnas.create-event')->with('data', $data);
        } elseif ($event->id_type == 2) {
            return view('fe-semnas.create-event-none')->with('data', $data);
        }

        return redirect()->back()->with('error', 'Failed!');
    }

    public function createEvent(Request $request)
    {
        try {

            $file = $request->file('file_hasil_cek_turnitin');
            $file2 = $request->file('file_ojs');

            $filePathName = $request->event_list . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_hasil_cek_turnitin.pdf';
            $filePathName2 = $request->event_list . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_ojs.pdf';

            $file->storeAs('public/file_turnitin', $filePathName);
            $file2->storeAs('public/file_ojs', $filePathName2);

            $data = [
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
                'hasil_cek_turnitin' => $request->hasil_cek_turnitin,
                'file_hasil_cek_turnitin' => $filePathName,
                'category' => $request->category,
                'link_url_ojs' => $request->link_url_ojs,
                'file_ojs' => $filePathName2,
                'date' => date('Y-m-d'),
            ];

            $create = Event::create($data);

            if ($create) {
                return redirect('/cart-event')->with('success', 'Submit data successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception Error ');
        }
    }

    function orderIdOtomatis()
    {
        $lastEvent = Event::latest()->first();
        $lastId = $lastEvent ? (int) explode('/', $lastEvent->id)[0] : 0;

        $newId = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        $seminarName = strtoupper(request()->seminar_name);
        $eventList = request()->event_list;
        $userId = Auth::user()->id;
        $currentDate = date('Y-m-d-H-i-s');

        $id = "INV-{$newId}-{$eventList}-{$userId}-{$currentDate}";

        return $id;
    }

    public function cartEventView(Request $request)
    {
        $event = Event::select('event.*', 'event_type.nama as type_name', 'event_list.harga as event_harga', 'event_list.foto as event_foto')
            ->join('event_list', 'event.event_list', '=', 'event_list.id')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->where('event.id_user', Auth::user()->id)
            ->where('event.konfirmasi_bayar', 0)
            ->where('event.status', 1)
            ->get();

        $eventNon = EventNon::select('event_non.*', 'event_type.nama as type_name', 'event_list.harga as event_harga', 'event_list.foto as event_foto')
            ->join('event_list', 'event_non.event_list', '=', 'event_list.id')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->where('event_non.id_user', Auth::user()->id)
            ->where('event_non.konfirmasi_bayar', 0)
            ->where('event_non.status', 1)
            ->get();

        $data = [
            'event' => $event,
            'eventNon' => $eventNon
        ];

        return view('fe-semnas.cart-event')->with('data', $data);
    }

    public function deleteEvent(Request $request)
    {
        try {
            $data = [
                'status' => 0,
            ];

            $event = Event::where('id', $request->event_id)->update($data);

            if ($event) {
                return redirect()->back()->with('success', 'Data deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception Error ');
        }
    }

    public function editEvent(Request $request)
    {
        try {

            $file = $request->file('file_hasil_cek_turnitin');
            $file2 = $request->file('file_ojs');

            $filePathName = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_hasil_cek_turnitin.pdf';
            $filePathName2 = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_ojs.pdf';

            $file->storeAs('public/file_turnitin', $filePathName);
            $file2->storeAs('public/file_ojs', $filePathName2);

            $data = [
                'hasil_cek_turnitin' => $request->hasil_cek_turnitin,
                'file_hasil_cek_turnitin' => $filePathName,
                'file_ojs' => $filePathName2,
                'review' => "Telah Direvisi",
            ];

            $event = Event::findOrFail($request->id);
            $update = $event->update($data);

            if ($update) {
                return redirect()->back()->with('success', 'Edit data successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception Error ' . $e->getMessage());
        }
    }

    public function inoviceEvent(Request $request)
    {
        $event = Event::select('event.*', 'event_type.nama as type_name', 'event_list.harga as event_harga', 'event_list.foto as event_foto')
            ->join('event_list', 'event.event_list', '=', 'event_list.id')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->where('event.id_user', Auth::user()->id)
            ->where('event.konfirmasi_bayar', 0)
            ->where('event.status', 1)
            ->get();

        $eventNon = EventNon::select('event_non.*', 'event_type.nama as type_name', 'event_list.harga as event_harga', 'event_list.foto as event_foto')
            ->join('event_list', 'event_non.event_list', '=', 'event_list.id')
            ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
            ->where('event_non.id_user', Auth::user()->id)
            ->where('event_non.konfirmasi_bayar', 0)
            ->where('event_non.status', 1)
            ->get();


        // Untuk mengecek apakah ada order id yang null
        $hasNullOrderId = $event->contains(function ($e) {
            return is_null($e->order_id);
        });

        $hasNullOrderId2 = $eventNon->contains(function ($e) {
            return is_null($e->order_id);
        });

        if ($hasNullOrderId || $hasNullOrderId2) {
            $orderId = $this->orderIdOtomatis();

            foreach ($event as $e) {
                $e->order_id = $orderId;
                $e->save();
            }

            foreach ($eventNon as $e) {
                $e->order_id = $orderId;
                $e->save();
            }
        }

        $data = [
            'event' => $event,
            'eventNon' => $eventNon
        ];

        return view('fe-semnas.invoice-event')->with('data', $data);
    }

    public function createEventNon(Request $request)
    {
        try {
            $data = [
                'id_user' => Auth::user()->id,
                'event_list' => $request->event_list,
                'seminar_name' => $request->seminar_name,
                'nama_lengkap' => $request->nama_lengkap,
                'institusi_asal' => $request->institusi_asal,
                'bidang_ilmu' => $request->bidang_ilmu,
                'alamat_institusi' => $request->alamat_institusi,
                'kota' => $request->kota,
                'date' => date('Y-m-d'),
            ];

            $create = EventNon::create($data);

            if ($create) {
                return redirect('/cart-event')->with('success', 'Submit data successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteEventNon(Request $request)
    {
        try {
            $data = [
                'status' => 0,
            ];

            $event = EventNon::where('id', $request->event_id)->update($data);

            if ($event) {
                return redirect()->back()->with('success', 'Data deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception Error ');
        }
    }

    public function downloadFile()
    {
        return view('fe-semnas.download-file');
    }
}
