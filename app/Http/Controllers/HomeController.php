<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = User::role('doctor')->orderBy('name')->get();
        $specialties = Specialty::orderBy('name')->get();
        if (Auth::check()) {
            $role = Auth::user()->roles->pluck('name')->join('');
            $user = auth()->user();
            switch ($role) {
                case 'super-admin':
                    return redirect()->route('admin.index');
                    break;
                case 'admin':
                    return redirect()->route('admin.index');
                    break;
                case 'doctor':
                    return redirect()->route('doctor.index');
                    break;
                    case 'pharmacist':
                        return redirect()->route('services.index');
                        break;
                case 'patient':
                    return view('welcome',compact('doctors','specialties'));
                    break;
                case 'user':
                    return view('welcome',compact('doctors','specialties'));
                    break;
                case '':
                    return view('welcome',compact('doctors','specialties'));
                    break;
            }
        } else {
            return view('welcome');
        }
    }
}
