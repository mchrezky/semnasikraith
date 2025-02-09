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

class KonfirmasiPembayaranController extends Controller
{

    public function index()
    {
        $order = Pembayaran::select('pembayaran.*', 'users.name as user_name', 'users.tipe_user as user_tipe_user', 'users.institusi_asal as user_institusi_asal')
            ->join('users', 'pembayaran.id_user', '=', 'users.id')
            ->where('pembayaran.status', '2')
            ->get();

        $data = [
            'order' => $order
        ];

        return view('be-semnas.konfirmasi-pembayaran')->with('data', $data);
    }

    public function update(Request $request)
    {
        try {

            $update = [
                'konfirmasi_bayar' => 3,
            ];

            $update2 = [
                'status' => 3,
                'updated_by' => Auth::user()->id
            ];

            $pembayaran = Pembayaran::where('id', $request->id)->update($update2);
            $event = Event::where('order_id', $request->id)->update($update);
            $eventnon = EventNon::where('order_id', $request->id)->update($update);


            if ($pembayaran) {
                return redirect()->back()->with('success', 'Submit data successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
