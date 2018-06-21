<?php

namespace App\Http\Controllers;

use App\Programari;
//use App\Pacient;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use DateTime;
class ProgramariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = 20;
        $programs = DB::table('programaris')
            ->leftJoin('pacients', 'programaris.pacient_id', '=', 'pacients.id')
            ->select('programaris.*', 'pacients.firstname', 'pacients.lastname')
            ->paginate(20);
       // dd($programs);die;
        return view('program.index', array(
                'programs' => $programs, 'title' => 'Lista programari',
                'page_title' => 'Lista Programari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('program.create',  array('page_title' => 'Introduce programare', 
        'title' => 'Introduce programare)'));
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
            'pacient_id' => 'required',
            'startdate' => 'required',
            'starthour' => 'required'
            )
        );

        $input = $request->all();
        Programari::create($input);
        Session::flash('flash_message', 'Programare facuta!');
        return redirect()->route('pacients');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programs = Programari::with('pacient')->findOrFail($id);
        return view('program.show', array('title'=>'Detalii programari', 'programs' => $programs));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programs = Programari::with('pacient')->findOrFail($id);
        return view('program.edit', array('programs' => $programs, 'title' => 'Editare programare'));
        /*
         $consults = DB::table('consults')
            ->leftJoin('pacients', 'consults.pacientid', '=', 'pacients.id')
            ->select('consults.*', 'pacients.firstname', 'pacients.lastname', 'pacients.cnp')
            ->orderBy('consults.created_at', 'desc')
            ->paginate(20);
            */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $programs = Programari::findOrFail($id);
       /* $this->validate($request,  array(
                            'firstname' => 'required',
                            'lastname' => 'required',
                            'birthdate' => 'required',
                            'cnp' => 'required',//['required', 'regex:/^[0-9]{14}$/'],
                            'address' => 'required',
                            'phone' => 'required',
                            )
                        );*/
 
        $input = $request->all();
        $programs->fill($input)->save();
 
        Session::flash('flash_message', 'Programare salvata!');
        return redirect()->route('program');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $programari
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = Programari::findOrFail($id);
 
        $program->delete();
 
        Session::flash('flash_message', 'Programare anulata/stearsa!');
 
        return redirect()->route('program');
    }

    /**
     * Display a listing of the resource in json.
     *
     * @return \Illuminate\Http\Response
     */
    //https://github.com/Serhioromano/bootstrap-calendar/blob/master/events.json.php
    public function eventscomplete()
    {
        $programs = Programari::with('pacient')->get();
        foreach ($programs as $program)
        {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $program->startdate." ".$program->starthour );
           // dd($date);
            $results[] = 
            [
                'id' => $program->id, 
                'title' => $program->pacient->firstname ." ". $program->pacient->lastname ." (". $program->pacient->cnp.")",
                'start' => substr($date->format('c'),0,-6),
                'end' => substr($date->format('c'),0,-6),
                "class"=> "event-warning",
             ]; 
        }
        if(!isset($results))
        {
            $results1['success']= 0; 
        }
        else {
            $results1['success']= 1;
            $results1['result']= $results;
        
        }
        return response()->json($results1);
    }
}
