<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Faq;
use App\Models\Team;
use App\Models\Therapy;
use App\Models\Treatment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $TeamCount = Team::count();
        $TherapyCount = Therapy::count();
        $TreatmentCount = Treatment::count();
        $BlogCount = Blog::count();
        $FaqCount = Faq::count();
        return view('admin.dashboard', compact('TeamCount', 'TherapyCount', 'TreatmentCount', 'BlogCount', 'FaqCount'));
    }
}