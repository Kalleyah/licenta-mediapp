<?php

namespace App\Http\Controllers;

use App\Concediimedicale;
use App\Consults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ConcediimedicaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = 20;
        $concedii = DB::table('concediimedicales')
            ->leftJoin('pacients', 'concediimedicales.pacient_id', '=', 'pacients.id')
            ->select('concediimedicales.*', 'pacients.firstname', 'pacients.lastname', 'pacients.cnp')
            ->orderBy('concediimedicales.created_at', 'desc')
            ->paginate(20);
            //->paginate($itemsPerPage)
            //->get();

        return view('concediimedicales.index', array('concedii' => $concedii, 'title' => 'Lista Concedii',
        'page_title' => 'Lista Concedii'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('concediimedicales.create',
             array('page_title' => 'Introduce Concediu medical',
              'title' => 'Introduce Concediu'));
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
            'serie'  => 'required', 
            'diagnostic' => 'required',
            'duration'  => 'required'
            )
        );
        $input = $request->all();
        
        list($input['startdate'],$input['enddate']) = explode(' - ',$input['rezervation'],2);
        unset($input['rezervation']);
        Concediimedicale::create($input);

        $consult = Consults::findOrFail($input['consultid']);
        $consult->medicalbreak = 1;
        $consult->save();

        Session::flash('flash_message', 'Concediu adaugata!');
        return redirect()->route('pacients.show' ,['id' => $input['pacient_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $concediimedicale
     * @return \Illuminate\Http\Response
     */
    public function show($concediimedicale)
    {
        $concediu = Concediimedicale::where('id', $concediimedicale)->first();
        return view('concediimedicales.show', array('concediu' => $concediu));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer $concediimedicale
     * @return \Illuminate\Http\Response
     */
    public function edit($concediimedicale)
    {
        $concediu = Concediimedicale::findOrFail($concediimedicale);
        return view('concediimedicales.edit', 
        array('concediu' => $concediu,'page_title' => 'Editare concediu', 'title' => 'Editare concediu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $concediimedicale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $concediimedicale)
    {
        $concediu = Concediimedicale::findOrFail($concediimedicale);
 
        $this->validate($request, array(
            'pacient_id' => 'required',
            'serie'  => 'required', 
            'diagnostic' => 'required',
            'duration'  => 'required',
            )
        );
        $input = $request->all();
        $concediu->fill($input)->save();
        Session::flash('flash_message', 'Modificarile au fost salvate!');
        return redirect()->route('pacients.show' ,['id' => $concediu->pacient_id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $concediimedicale
     * @return \Illuminate\Http\Response
     */
    public function destroy($concediimedicale)
    {
        $concediu = Concediimedicale::findOrFail($concediimedicale);
        $concediu->delete();
        Session::flash('flash_message', 'Concediu stears!');
        return redirect()->route('concedii');
    }

    public function ws_concediiconsult(Request $request)
    {
        $term = $request->term;
    
        $cmperday = DB::table('concediimedicales')
                ->select(DB::raw('date(created_at) as data'), DB::raw('count(id) as totalconcedii'))
                ->groupBy(DB::raw('1'))
                ->get();
        $consperday = DB::table('consults')
                ->select(DB::raw('date(created_at) as data'), DB::raw('count(id) as totalconsult'))
                ->groupBy(DB::raw('1'))
                ->get();
       // dd($cmperday);

        foreach ($consperday as $cmp)
        {
            $founded = 0;
            foreach($cmperday as $cc )
            {
                if($cc->data == $cmp->data)
                {
                    $founded = 1;
                    $results[] = ['date' => $cmp->data
                    ,
                    'source1' =>  $cmp->totalconsult,
                    'source2' =>  $cc->totalconcedii]; 
                }
            }
            if($founded == 0)
            {
                $results[] = ['date' => $cmp->data
                    ,
                    'source1' =>  $cmp->totalconsult,
                    'source2' =>  0]; 
            }
        }
        

        if(!isset($results))
        {
            $results[] = [];
        }
        return response()->json($results);
    }

}
