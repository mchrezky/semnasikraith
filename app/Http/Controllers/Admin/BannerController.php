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
use App\Models\Table\Banner;

class BannerController extends Controller
{

    public function index()
    {
        $banner = Banner::where('is_deleted', false)->get();

        $data = [
            'banner' => $banner
        ];

        return view('be-semnas.master-banner')->with('data', $data);
    }

    public function create(Request $request)
    {
        try {

            $file = $request->file('file_banner');

            $extension = $file->getClientOriginalExtension();

            $filePathName = Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_banner.' . $extension;

            $file->storeAs('public/file_banner', $filePathName);

            $data = [
                'title' => $request->title,
                'foto' => $filePathName,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];

            $create = Banner::create($data);

            if ($create) {
                return redirect('/master-banner')->with('success', 'Data created successfully.');
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

            if ($request->file('file_banner') != null) {
                $file = $request->file('file_banner');

                $extension = $file->getClientOriginalExtension();

                $filePathName = $request->id . '_' . Auth::user()->id . '_' . now()->format('Ymd_His') . '_file_banner.' . $extension;

                $file->storeAs('public/file_banner', $filePathName);

                $data = [
                    'title' => $request->title,
                    'foto' => $filePathName,
                    'updated_by' => Auth::user()->id,
                ];
            } else {
                $data = [
                    'title' => $request->title,
                    'updated_by' => Auth::user()->id,
                ];
            }

            $banner = Banner::findOrFail($request->id);
            $update = $banner->update($data);

            if ($update) {
                return redirect('/master-banner')->with('success', 'Data updated successfully.');
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

            $banner = Banner::findOrFail($request->id);
            $update = $banner->update($data);

            if ($update) {
                return redirect('/master-banner')->with('success', 'Data deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete data.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error Request, Exception: ' . $e->getMessage());
        }
    }
}
