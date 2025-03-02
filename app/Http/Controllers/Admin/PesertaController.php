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
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PesertaController extends Controller
{

    public function index()
    {
        $dataPeserta = User::get();

        $data = [
            'dataPeserta' => $dataPeserta
        ];

        return view('be-semnas.data-peserta')->with('data', $data);
    }

    public function toReset(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $data = [
                'password' => Hash::make($user->email . date('Y')),
            ];

            $update = $user->update($data);

            if ($update) {
                return redirect('/data-peserta')->with('success', 'Data updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }

    public function toReviewer(Request $request)
    {
        try {
            $data = [
                'role' => "Reviewer",
            ];

            $user = User::findOrFail($request->id);
            $update = $user->update($data);

            if ($update) {
                return redirect('/data-peserta')->with('success', 'Data updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }

    public function deleteReviewer(Request $request)
    {
        try {
            $data = [
                'role' => "Guest",
            ];

            $user = User::findOrFail($request->id);
            $update = $user->update($data);

            if ($update) {
                return redirect('/data-peserta')->with('success', 'Data updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to update data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }
}
