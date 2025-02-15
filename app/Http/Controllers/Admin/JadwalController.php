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
use App\Models\Table\Jadwal;

class JadwalController extends Controller
{

    public function index()
    {
        $jadwal = Jadwal::get();

        $data = [
            'jadwal' => $jadwal
        ];

        return view('be-semnas.master-jadwal')->with('data', $data);
    }

    public function update(Request $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'ket' => $request->ket,
            ];

            $jadwal = Jadwal::findOrFail($request->id);
            $update = $jadwal->update($data);

            if ($update) {
                return redirect('/master-jadwal')->with('success', 'Data updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }
}
