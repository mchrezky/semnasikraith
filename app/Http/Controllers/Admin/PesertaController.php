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
}
