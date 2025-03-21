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
use App\Models\Table\MsSemnas;

class MsSemnasController extends Controller
{

    public function index()
    {
        $msSemnas = MsSemnas::where('status', 1)->get();

        $data = [
            'msSemnas' => $msSemnas
        ];

        return view('be-semnas.master-semnas')->with('data', $data);
    }

    public function create(Request $request)
    {
        try {

            $file = $request->file('file_ms_semnas');
            $file2 = $request->file('file_sertifikat_pemakalah');
            $file3 = $request->file('file_sertifikat_non_pemakalah');

            $extension = $file->getClientOriginalExtension();
            $extension2 = $file2->getClientOriginalExtension();
            $extension3 = $file3->getClientOriginalExtension();

            $filePathName = Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_ms_semnas.' . $extension;
            $filePathName2 = Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_sertifikat_pemakalah.' . $extension2;
            $filePathName3 = Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_sertifikat_non_pemakalah.' . $extension3;

            $file->storeAs('public/file_ms_semnas', $filePathName);
            $file2->storeAs('public/file_ms_semnas', $filePathName2);
            $file3->storeAs('public/file_ms_semnas', $filePathName3);

            $data = [
                'name' => $request->name,
                'foto' => $filePathName,
                'file_sertifikat_pemakalah' => $filePathName2,
                'file_sertifikat_non_pemakalah' => $filePathName3,
                'tema' => $request->tema,
                'tanggal' => $request->tanggal,
            ];

            $create = MsSemnas::create($data);

            if ($create) {
                return redirect('/master-semnas')->with('success', 'Data created successfully.');
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
                'name' => $request->name,
                'tema' => $request->tema,
                'tanggal' => $request->tanggal,
            ];

            // Cek apakah file_ms_semnas diunggah
            if ($request->hasFile('file_ms_semnas')) {
                $file = $request->file('file_ms_semnas');
                $extension = $file->getClientOriginalExtension();
                $filePathName = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_ms_semnas.' . $extension;
                $file->storeAs('public/file_ms_semnas', $filePathName);

                $data['foto'] = $filePathName;
            }

            // Cek apakah file_sertifikat_pemakalah diunggah
            if ($request->hasFile('file_sertifikat_pemakalah')) {
                $file2 = $request->file('file_sertifikat_pemakalah');
                $extension2 = $file2->getClientOriginalExtension();
                $filePathName2 = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_sertifikat_pemakalah.' . $extension2;
                $file2->storeAs('public/file_ms_semnas', $filePathName2);

                $data['file_sertifikat_pemakalah'] = $filePathName2;
            }

            // Cek apakah file_sertifikat_non_pemakalah diunggah
            if ($request->hasFile('file_sertifikat_non_pemakalah')) {
                $file3 = $request->file('file_sertifikat_non_pemakalah');
                $extension3 = $file3->getClientOriginalExtension();
                $filePathName3 = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_sertifikat_non_pemakalah.' . $extension3;
                $file3->storeAs('public/file_ms_semnas', $filePathName3);

                $data['file_sertifikat_non_pemakalah'] = $filePathName3;
            }

            $msSemnas = MsSemnas::findOrFail($request->id);
            $update = $msSemnas->update($data);

            if ($update) {
                return redirect('/master-semnas')->with('success', 'Data updated successfully.');
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

            $msSemnas = MsSemnas::findOrFail($request->id);
            $update = $msSemnas->update($data);

            if ($update) {
                return redirect('/master-semnas')->with('success', 'Data deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }
}
