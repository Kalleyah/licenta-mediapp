<?php

namespace App\Http\Controllers;

use App\Consults;
use App\Pacient;
use App\User;
use App\Concediimedicale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use DataTables;

class ConsultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = 20;
        //$consults = Consults::orderBy('created_at', 'desc')->paginate($itemsPerPage);
        $consults = DB::table('consults')
            ->leftJoin('pacients', 'consults.pacient_id', '=', 'pacients.id')
            ->leftJoin('users', 'consults.medic', '=', 'users.id')
            ->select('consults.*', 'pacients.firstname', 'pacients.lastname', 'pacients.cnp', 'users.name')
            ->orderBy('consults.created_at', 'desc')
            ->paginate(20);
        return view('consults.index', array('consults' => $consults, 'page_title' => 'Lista consultatii'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consults.create', array('page_title' => 'Introduce consultatie', 'title' => 'Introduce consultatie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            //'pacient_id' => 'required',
            //'diagnostics' => 'required'
            )
        );

        $input = $request->all();
        $cid = Consults::create($input)->id;

        Session::flash('flash_message', 'Consultatie adaugata!');
        return redirect()->route('consults.show' , ['id' => $cid]);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $consults
     * @return \Illuminate\Http\Response
     */
    public function show($cid)
    {
        $consults = Consults::where('id', $cid)->first();
        $medic = User::where('id', $consults->medic)->first();
        $pacient = Pacient::where('id', $consults->pacient_id)->first();
        $concedii = Concediimedicale::where('consultid', $cid)->first();

       return view('consults.show', 
        array(
            'consults' => $consults, 
            'pacient' => $pacient,
            'medic' => $medic,
            'concedii' => $concedii,
        'page_title' => 'Detalii consultatie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer  $consults
     * @return \Illuminate\Http\Response
     */
    public function edit($consults)
    {
        $consults = Consults::findOrFail($consults);
        return view('consults.edit', array('consults' => $consults, 'page_title' => 'Editare consultatie', 'title' => 'Editare consultatie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $consults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $consults)
    {
        $consults = Consults::findOrFail($consults);
 
        $this->validate($request, array(
            'pacient_id' => 'required',
            'diagnostics' => 'required'
                            )
                        );
 
        $input = $request->all();
 
        $consults->fill($input)->save();
 
        Session::flash('flash_message', 'Modificarile au fost salvate!');
 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $consults
     * @return \Illuminate\Http\Response
     */
    public function destroy($consults)
    {
        $consults = Consults::findOrFail($consults);
        $consults->delete();
        Session::flash('flash_message', 'Consultatia a fost stearsa!');
        return redirect()->route('consults');
    }
}
