<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InfoController extends Controller
{
    public function index()
    {
        if(!auth()->user()){
            return redirect('/login');
        }
        $desde = today();
        $hasta = now()->addDays(15);
        $anterior = now()->subDays(90);
        $patient_id = auth()->user()->id;
        $appoinments =Appoinment::where('patient_id', $patient_id)->orderBy('date', 'desc')->orderBy('hour', 'asc')->get();

        $interviews =Interview ::where('user_id', $patient_id)->orderBy('date', 'desc')->get();

        $medicines = DB::table('interview_medicine')->where('user_id', $patient_id)->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('appoinments','interviews','medicines'));
    }
}
