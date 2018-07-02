<?php

namespace App\Http\Controllers;

use App\Raports;
//use Auth;
use App\User;
use App\Concediimedicale;
use App\Consults;
use App\Pacient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// PdfReport Aliases
use PdfReport;


class RaportsController extends Controller
{

    public function indexconcedii(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
       
        if ($request->isMethod('post')) 
        {
            $page_title = 'Concedii medicale pe perioada '.$fromDate.' - '.$toDate;
            $concedii =  DB::table('concediimedicales')
            ->leftJoin('pacients', 'concediimedicales.pacient_id', '=', 'pacients.id')
            ->leftJoin('users', 'concediimedicales.medic', '=', 'users.id')
            ->select('concediimedicales.*', 'pacients.firstname', 'pacients.lastname', 'pacients.cnp','users.name')
            ->whereBetween('startdate', [$fromDate, $toDate])
            ->orwhereBetween('enddate', [$fromDate, $toDate])
            ->orderBy('concediimedicales.startdate', 'asc')
            ->get();
        }
        else {
            $page_title = 'Ultimele 25 de concedii date';
            $concedii =  DB::table('concediimedicales')
            ->leftJoin('pacients', 'concediimedicales.pacient_id', '=', 'pacients.id')
            ->leftJoin('users', 'concediimedicales.medic', '=', 'users.id')
            ->select('concediimedicales.*', 'pacients.firstname', 'pacients.lastname', 'pacients.cnp','users.name')
            ->orderBy('concediimedicales.created_at', 'desc')
            ->limit(25)
            ->get();
        }
        //dd($concedii);die;
        return view('reports.index', array(
                'concedii' => $concedii, 
                'from' => $fromDate, 
                'to' => $toDate, 
                'title' => $page_title,
                'page_title' => 'Raport concedii medicale'));
    }

    public function displayReport(Request $request) {
        // Retrieve any filters
        $fromDate = $request->input('sec_from_date');
        $toDate = $request->input('sec_to_date');
        //dd($request);
        // Report title
        $title = 'Concedii medicale - MediApp ';
    
        // For displaying filters description on header
        $meta = [
            'Pe perioada ' => $fromDate . ' - ' . $toDate,
        ];
    
        // Do some querying..
        $queryBuilder = Concediimedicale::select(
            ['pacient_id', 'serie', 'concediimedicales.created_at', 'diagnostic','duration',
            'startdate','enddate','pacients.firstname', 'pacients.lastname', 'pacients.cnp','users.name'])
            ->join('pacients',  'concediimedicales.pacient_id', '=', 'pacients.id')
            ->leftJoin('users', 'concediimedicales.medic', '=', 'users.id')
            ->whereBetween('startdate', [$fromDate, $toDate])
            ->orwhereBetween('enddate', [$fromDate, $toDate])
            ->orderBy('concediimedicales.startdate', 'asc');
        
        // Set Column to be displayed
        $columns = [
            'Seria' => 'serie',
            'Nume' => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->firstname . " ".$result->lastname);
            },
            'CNP' => 'cnp',
            'Diagnostic' => 'diagnostic',
            'Perioada' => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->startdate->format('Y-m-d') . " - ".$result->enddate->format('Y-m-d'));
            },
            'Durata' => function($result) { 
                return ($result->duration . " zile");
            },
            'Medic' => 'name',
            //'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
           /* 'Status' => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            }*/
        ];
    
        /*
            Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
    
            - of()         : Init the title, meta (filters description to show), query, column (to be shown)
            - editColumn() : To Change column class or manipulate its data for displaying to report
            - editColumns(): Mass edit column
            - showTotal()  : Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            - groupBy()    : Show total of value on specific group. Used with showTotal() enabled.
            - limit()      : Limit record to be showed
            - make()       : Will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
        */
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                       /* ->editColumn('Registered At', [
                            'displayAs' => function($result) {
                                return $result->created_at->format('d M Y');
                            }
                        ])*/
                      /*  ->editColumn('Total Balance', [
                            'displayAs' => function($result) {
                                return thousandSeparator($result->balance);
                            }
                        ])*/
                       /* ->editColumns(['Total Balance', 'Status'], [
                            'class' => 'right bold'
                        ])*/
                       /*->showTotal([
                            'duration' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                        ])*/
                        ->stream(); // or download('filename here..') to download pdf
    }

    public function indexboli(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
       
        if ($request->isMethod('post')) 
        {
            $page_title = 'Boli frecvete in perioada '.$fromDate.' - '.$toDate;
            $consults = DB::table('consults')
            ->whereBetween('consultdate', [$fromDate, $toDate])
            ->select('codboala','diagnostics', DB::raw('count(*) as total'))
            ->groupBy(['codboala','diagnostics'])
            ->orderBy('total', 'desc')
            ->get();
        }
        else {
            $page_title = 'Cele mai frecvente 25 de boli';
            $consults =  DB::table('consults')
            //->leftJoin('pacients', 'consults.pacient_id', '=', 'pacients.id')
            ->select('codboala','diagnostics', DB::raw('count(*) as total'))
            ->groupBy(['codboala','diagnostics'])
            ->orderBy('total', 'desc')
            ->limit(25)
            ->get();
        }
       // dd($consults);die;
        return view('reports.index1', array(
                'consults' => $consults, 
                'from' => $fromDate, 
                'to' => $toDate, 
                'title' => $page_title,
                'page_title' => 'Raport Boli frecvente'));
    }

    public function displayReport1(Request $request) {
        // Retrieve any filters
        $fromDate = $request->input('sec_from_date');
        $toDate = $request->input('sec_to_date');
        //dd($request);
        // Report title
        $title = 'Boli frecvente - MediApp ';
    
        // For displaying filters description on header
        $meta = [
            'Pe perioada ' => $fromDate . ' - ' . $toDate,
        ];
    
        // Do some querying..
        $queryBuilder = Consults::select(
            ['codboala','diagnostics', DB::raw('count(*) as total')])
            ->whereBetween('consultdate', [$fromDate, $toDate])
            ->groupBy(['codboala','diagnostics'])
            ->orderBy('total', 'desc');
        
        // Set Column to be displayed
        $columns = [
            'Cod boala' => 'codboala',
            'Diagnostic' => 'diagnostics',
            'Nr. diagnostic' => 'total',
            
            //'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
           /* 'Status' => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            }*/
        ];
    
        /*
            Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
    
            - of()         : Init the title, meta (filters description to show), query, column (to be shown)
            - editColumn() : To Change column class or manipulate its data for displaying to report
            - editColumns(): Mass edit column
            - showTotal()  : Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            - groupBy()    : Show total of value on specific group. Used with showTotal() enabled.
            - limit()      : Limit record to be showed
            - make()       : Will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
        */
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                       /* ->editColumn('Registered At', [
                            'displayAs' => function($result) {
                                return $result->created_at->format('d M Y');
                            }
                        ])*/
                      /*  ->editColumn('Total Balance', [
                            'displayAs' => function($result) {
                                return thousandSeparator($result->balance);
                            }
                        ])*/
                       /* ->editColumns(['Total Balance', 'Status'], [
                            'class' => 'right bold'
                        ])*/
                       /*->showTotal([
                            'duration' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                        ])*/
                        ->stream(); // or download('filename here..') to download pdf
    }

    
    public function indexpacient(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
       
        if ($request->isMethod('post')) 
        {
            $page_title = 'Pacienti noi pe perioada '.$fromDate.' - '.$toDate;
            $concedii =  DB::table('concediimedicales')
            ->leftJoin('pacients', 'concediimedicales.pacient_id', '=', 'pacients.id')
            ->select('concediimedicales.*', 'pacients.firstname', 'pacients.lastname', 'pacients.cnp')
            ->whereBetween('startdate', [$fromDate, $toDate])
            ->orwhereBetween('enddate', [$fromDate, $toDate])
            ->orderBy('concediimedicales.startdate', 'asc')
            ->get();

        }
        else {
            $page_title = 'Pacienti xxx';
            $concedii =  DB::table('concediimedicales')
            ->leftJoin('pacients', 'concediimedicales.pacient_id', '=', 'pacients.id')
            ->select('concediimedicales.*', 'pacients.firstname', 'pacients.lastname', 'pacients.cnp')
            ->orderBy('concediimedicales.created_at', 'desc')
            ->limit(25)
            ->get();
        }
        //dd($concedii);die;
        return view('reports.index2', array(
                'concedii' => $concedii, 
                'from' => $fromDate, 
                'to' => $toDate, 
                'title' => $page_title,
                'page_title' => 'Raport Pacienti'));
    }    
}
