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
use App\Models\Table\Pembayaran;
use App\Models\Table\Event;
use App\Models\Table\EventNon;
use App\Models\Table\Categories;
use App\Exports\EventExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Table\MsSemnas;

class EventAdminController extends Controller
{

    public function index()
    {
        $dataPemakalah = Event::select('event.*', 'users.name as user_name', 'users.tipe_user as user_tipe_user', 'users.institusi_asal as user_institusi_asal')
            ->join('users', 'event.id_user', '=', 'users.id')
            ->get();

        $msSemnas = MsSemnas::where('status', 1)->get();

        $data = [
            'dataPemakalah' => $dataPemakalah,
            'msSemnas' => $msSemnas
        ];

        return view('be-semnas.data-pemakalah')->with('data', $data);
    }

    public function exportDataPemakalahToExcel(Request $request)
    {
        $date = $request->get('date');
        $semnasId = $request->get('semnas_id');

        return Excel::download(new EventExport($date, $semnasId), 'data_pemakalah.xlsx');
    }

    public function editPemakalah($id)
    {
        $dataPemakalah = Event::select('event.*', 'event_list.nama as event_list_name', 'event_list.ket as event_list_ket', 'event_list.harga as event_list_harga', 'event_list.foto as event_list_foto', 'users.name as user_name', 'users.tipe_user as user_tipe_user', 'users.institusi_asal as user_institusi_asal')
            ->join('users', 'event.id_user', '=', 'users.id')
            ->join('event_list', 'event.event_list', '=', 'event_list.id')
            ->where('event.id', $id)
            ->first();

        if (!$dataPemakalah) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        }

        $categories = Categories::all();

        $data = [
            'event' => $dataPemakalah,
            'categories' => $categories
        ];

        return view('be-semnas.edit-data-pemakalah')->with('data', $data);
    }

    public function editPemakalahSubmit(Request $request)
    {
        try {
            $file = $request->file('file_loa');

            if ($file) {
                $filePathName = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_loa.pdf';

                $file->storeAs('public/file_loa', $filePathName);

                $data = [
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
                    'category' => $request->category,
                    'file_loa' => $filePathName,
                ];
            } else {
                $data = [
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
                    'category' => $request->category,
                ];
            }

            $event = Event::findOrFail($request->id);
            $update = $event->update($data);

            if ($update) {
                return redirect('/data-pemakalah')->with('success', 'Data updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }

    public function index2()
    {
        $dataNonPemakalah = EventNon::select('event_non.*', 'users.name as user_name', 'users.tipe_user as user_tipe_user', 'users.institusi_asal as user_institusi_asal')
            ->join('users', 'event_non.id_user', '=', 'users.id')
            ->get();

        $data = [
            'dataNonPemakalah' => $dataNonPemakalah
        ];

        return view('be-semnas.data-non-pemakalah')->with('data', $data);
    }

    public function editNonPemakalah($id)
    {
        $dataNonPemakalah = EventNon::select('event_non.*', 'event_list.nama as event_list_name', 'event_list.ket as event_list_ket', 'event_list.harga as event_list_harga', 'event_list.foto as event_list_foto', 'users.name as user_name', 'users.tipe_user as user_tipe_user', 'users.institusi_asal as user_institusi_asal')
            ->join('users', 'event_non.id_user', '=', 'users.id')
            ->join('event_list', 'event_non.event_list', '=', 'event_list.id')
            ->where('event_non.id', $id)
            ->first();

        if (!$dataNonPemakalah) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        }

        $data = [
            'event' => $dataNonPemakalah
        ];

        return view('be-semnas.edit-data-non-pemakalah')->with('data', $data);
    }

    public function editNonPemakalahSubmit(Request $request)
    {
        try {
            $data = [
                'nama_lengkap' => $request->nama_lengkap,
                'institusi_asal' => $request->institusi_asal,
                'bidang_ilmu' => $request->bidang_ilmu,
                'alamat_institusi' => $request->alamat_institusi,
                'kota' => $request->kota,
            ];

            $event = EventNon::findOrFail($request->id);
            $update = $event->update($data);

            if ($update) {
                return redirect('/data-non-pemakalah')->with('success', 'Data updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }

    public function reviewPemakalah($id)
    {
        $dataPemakalah = Event::select('event.*', 'event_list.nama as event_list_name', 'event_list.ket as event_list_ket', 'event_list.harga as event_list_harga', 'event_list.foto as event_list_foto', 'users.name as user_name', 'users.tipe_user as user_tipe_user', 'users.institusi_asal as user_institusi_asal')
            ->join('users', 'event.id_user', '=', 'users.id')
            ->join('event_list', 'event.event_list', '=', 'event_list.id')
            ->where('event.id', $id)
            ->first();

        if (!$dataPemakalah) {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        }

        $categories = Categories::all();

        $data = [
            'event' => $dataPemakalah,
            'categories' => $categories
        ];

        return view('be-semnas.review-data-pemakalah')->with('data', $data);
    }

    public function reviewPemakalahSubmit(Request $request)
    {
        try {
            if ($request->abstrak == null || $request->metode_penelitian == null || $request->pembahasan == null || $request->kesimpulan == null || $request->plagriasi_turnitin == null || $request->ket_review == null) {
                $data = [
                    'review' => "Selesai",
                    'date_review' => date('Y-m-d H:i:s'),
                    'review_by' => Auth::user()->id
                ];
            } else {
                $data = [
                    'review' => "Telah Direview",
                    'abstrak' => $request->abstrak,
                    'metode_penelitian' => $request->metode_penelitian,
                    'pembahasan' => $request->pembahasan,
                    'kesimpulan' => $request->kesimpulan,
                    'plagriasi_turnitin' => $request->plagriasi_turnitin,
                    'ket_review' => $request->ket_review,
                    'date_review' => date('Y-m-d H:i:s'),
                    'review_by' => Auth::user()->id
                ];
            }

            $event = Event::findOrFail($request->id);
            $update = $event->update($data);

            if ($update) {
                return redirect('/data-pemakalah')->with('success', 'Data reviewed successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }
}
