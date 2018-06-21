<?php

namespace App\Http\Controllers;

use App\Pacient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentMonth = date('m');
        $currentTime = date('hh:MM:ss');
        $today = date('yy-mm-dd');
        $newpacient = DB::table("pacients")
                    ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
                    ->get()->count();
        $consultsmonth = DB::table("consults")
                    ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
                    ->get()->count();
        $rezervmonth = DB::table("programaris")
                    ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
                    ->get()->count();
        $upcomingrez = DB::table("programaris")
                    ->leftjoin('pacients', 'programaris.pacient_id', '=', 'pacients.id')
                    ->whereRaw('Date(startdate) = CURDATE()')
                    ->whereRaw('starthour >= ?',[$currentTime])
                    ->select('programaris.*', 'pacients.*')
                    ->orderBy('starthour', 'asc')
                    ->limit(5)
                    ->get();
        $totals = DB::table("consults")
            ->whereRaw('Date(consultdate) BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()')
            ->select(DB::raw('count(*) as cnt'))
            ->limit(1)
            ->first();
        $bolilunaasta = DB::table("consults")
                    ->whereRaw('Date(consultdate) BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()')
                    ->select('codboala','diagnostics', DB::raw('count(*) as total'))
                    ->groupBy(['codboala','diagnostics'])
                    ->orderBy('total', 'desc')
                    ->limit(5)
                    ->get();
       
        return view('dashboard', array(
            'page_title' => 'MediApp - Dashboard',
            'newpacient' => $newpacient,
            'consultsmonth' => $consultsmonth,
            'rezervmonth' => $rezervmonth,
            'upcomingrez' => $upcomingrez,
            'totalboli' => $totals,
            'bolilunaasta' => $bolilunaasta,

        ));
    }

    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
