<?php

namespace App\Http\Controllers;

use App\Pacient;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class PacientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = 20;
        $pacients = DB::table('pacients')->paginate(20);
        return view('pacients.index', array('pacients' => $pacients, 'page_title' => 'Lista pacienti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        return view('pacients.insertpacient',  array('page_title' => 'Introduce pacient', 'title' => 'Introduce pacient'));
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
            'firstname' => 'required',
            'lastname' => 'required',
            'birthdate' => 'required',
            'cnp' => 'required',//['required', 'regex:/^[0-9]{14}$/'],
            'address' => 'required',
            'phone' => 'required',
            )
        );
        $input = $request->all();
        // dd($input); // dd() helper function is print_r alternative
        Pacient::create($input);
        Session::flash('flash_message', 'Pacient nou introdus!');
        return redirect()->route('pacients');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $pacient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        $pacient = Pacient::where('id', $id)->first();
        $reservations = $pacient->reservations()->orderBy('startdate', 'desc')->first();
        $consults = $pacient->consults()->orderBy('consultdate', 'desc')->get();
        $concedii = $pacient->concedii()->orderBy('startdate', 'desc')->get();
        foreach($consults as $c)
        {
            if($c->medic>0)
            {
                $c->medicuser = User::find($c->medic)->name;
            }
            else{
                    $c->medicuser = 'NA';
                }
        }
        foreach($concedii as $co)
        {
            if($co->medic>0)
            {
                $co->medicuser = User::find($co->medic)->name;
            }
            else{
                    $co->medicuser = 'NA';
                }
        }
        #$pacient = Pacient::where('id', $id)->first();
        
        return view('pacients.show', 
            array('title'=>'Detalii pacient', 
            'page_title' => 'Detalii pacient', 
            'pacient' => $pacient,
            'reservations' => $reservations,
            'consults' => $consults,
            'concedii' => $concedii));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $pacient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacient = Pacient::findOrFail($id);
        return view('pacients.edit', array('pacient' => $pacient,  'page_title' => 'Editare date pacient', 'title' => 'Editare pacient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $pacient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pacient = Pacient::findOrFail($id);
        $this->validate($request,  array(
                            'firstname' => 'required',
                            'lastname' => 'required',
                            'birthdate' => 'required',
                            'cnp' => 'required',//['required', 'regex:/^[0-9]{14}$/'],
                            'address' => 'required',
                            'phone' => 'required',
                            )
                        );
 
        $input = $request->all();
        $pacient->fill($input)->save();
 
        Session::flash('flash_message', 'Pacient updatat!');
        return redirect()->route('pacients.show', array('id' => $pacient->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $pacient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pacient = Pacient::findOrFail($id);
 
        $pacient->delete();
 
        Session::flash('flash_message', 'Pacient sters!');
 
        return redirect()->route('pacients');
    }

  
    public function autocomplete(Request $request)
    {
        $term = $request->term;
    
        $queries = DB::table('pacients') //Your table name
            ->where('cnp', 'like', '%'.$term.'%') //Your selected row
            ->orWhere('firstname', 'like', '%'.$term.'%')
            ->orWhere('lastname', 'like', '%'.$term.'%')
            ->take(6)->get();
    
        foreach ($queries as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->firstname ." ". $query->lastname ." (". $query->cnp.")" ]; //you can take custom values as you want
        }
        if(!isset($results))
        {
            $results[] = ['id' => 0, 'value' => "NA" ];
        }
        return response()->json($results);
    }

    public function autousername(Request $request, $pacientid)
    {
        #$term = $request->term;
    
        $pacient = Pacient::findOrFail($pacientid);
        $results[] = ['id' => $pacient->id, 'value' => $pacient->firstname ." ". $pacient->lastname ." (". $pacient->cnp.")" ]; //you can take custom values as you want

        /*foreach ($pacient as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->firstname ." ". $query->lastname ." (". $query->cnp.")" ]; //you can take custom values as you want
        }*/
        if(!isset($results))
        {
            $results[] = ['id' => 0, 'value' => "NA" ];
        }
        return response()->json($results);
    }

}
