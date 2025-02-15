<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Table\Jadwal;
use App\Models\Table\Banner;
use App\Models\Table\EventList;
use App\Models\Table\MsSemnas;

class DashboardController extends Controller
{

    public function index()
    {

        $jadwal = Jadwal::limit(5)->get();
        $banner = Banner::where('is_deleted', false)->get();
        // $event = EventList::select('event_list.*', 'event_type.nama as type_name')->where('event_list.status', '1')
        //     ->join('event_type', 'event_list.id_type', '=', 'event_type.id')
        //     ->limit(2)
        //     ->get();
        $event = MsSemnas::where('status', '1')->get();

        $data = [
            'jadwal' => $jadwal,
            'event' => $event,
            'banner' => $banner
        ];

        return view('fe-semnas.welcome')->with('data', $data);
    }
}
