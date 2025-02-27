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

            $extension = $file->getClientOriginalExtension();

            $filePathName = Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_ms_semnas.' . $extension;

            $file->storeAs('public/file_ms_semnas', $filePathName);

            $data = [
                'name' => $request->name,
                'foto' => $filePathName,
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

            if ($request->file('file_ms_semnas') != null) {
                $file = $request->file('file_ms_semnas');

                $extension = $file->getClientOriginalExtension();

                $filePathName = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_ms_semnas.' . $extension;

                $file->storeAs('public/file_ms_semnas', $filePathName);

                $data = [
                    'name' => $request->name,
                    'foto' => $filePathName,
                    'tema' => $request->tema,
                    'tanggal' => $request->tanggal,
                ];
            } else {
                $data = [
                    'name' => $request->name,
                    'tema' => $request->tema,
                    'tanggal' => $request->tanggal,
                ];
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
