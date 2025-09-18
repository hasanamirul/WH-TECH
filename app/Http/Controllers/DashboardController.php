<?php
namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        // Anda bisa kirimkan data nyata dari model di sini
        return view('dashboard.index');
    }
}
