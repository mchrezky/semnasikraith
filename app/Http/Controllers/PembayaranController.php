<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Table\Pembayaran;
use App\Models\Table\Event;
use App\Models\Table\EventNon;
use Exception;

class PembayaranController extends Controller
{

    public function index()
    {

        $order = Pembayaran::select('pembayaran.*')->where('id_user', Auth::user()->id)
            ->get();

        $data = [
            'order' => $order
        ];
        // dd($data);
        return view('fe-semnas.riwayat-pembayaran')->with('data', $data);
    }

    public function create(Request $request)
    {
        try {
            $data = [
                'id' => $request->id,
                'id_user' => Auth::user()->id,
                'jumlah' => $request->jumlah,
                'created_by' => Auth::user()->id
            ];

            $update = [
                'konfirmasi_bayar' => 1,
            ];
            $create = Pembayaran::create($data);
            $event = Event::where('order_id', $request->id)->update($update);
            $eventnon = EventNon::where('order_id', $request->id)->update($update);


            if ($create) {
                return redirect('/riwayat-pembayaran')->with('success', 'Submit data successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {

            $file = $request->file('file_bukti_pembayaran');

            $extension = $file->getClientOriginalExtension();

            $filePathName = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_bukti_pembayaran.' . $extension;

            $file->storeAs('public/file_bukti_pembayaran', $filePathName);


            $update = [
                'konfirmasi_bayar' => 2,
            ];

            $update2 = [
                'file' => $filePathName,
                'note' => $request->note,
                'status' => 2,
                'tgl_bayar' => date('Y-m-d'),
                'updated_by' => Auth::user()->id
            ];

            $pembayaran = Pembayaran::where('id', $request->id)->update($update2);
            $event = Event::where('order_id', $request->id)->update($update);
            $eventnon = EventNon::where('order_id', $request->id)->update($update);


            if ($pembayaran) {
                return redirect('/riwayat-pembayaran')->with('success', 'Submit data successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
