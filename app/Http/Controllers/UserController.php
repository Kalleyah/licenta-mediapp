<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Auth;
use Hash;
use App\User;
use Session;
use DataTables;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemsPerPage = 20;
        $users = DB::table('users')
            ->paginate(20);
        return view('users.index', array(
                'users' => $users, 'title' => 'Lista utilizatori',
                'page_title' => 'Lista utilizatori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create',  array('page_title' => 'Introduce utilizator', 
        'title' => 'Introduce utilizator'));
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
            'name'                  => 'required|string|max:255|unique:users',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|string|confirmed|min:6',
            'password_confirmation' => 'required|string|same:password',
            )
        );
        $user = User::create([
            'name'             => $request->input('name'),
            'email'            => $request->input('email'),
            'password'         => bcrypt($request->input('password')),
        ]);

        $user->save();

        Session::flash('flash_message', 'Utilizator creat!');
        return redirect()->route('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', array('user' => $user, 'page_title' => 'Detalii utilizator', 'title' => 'Detalii utilizator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', array('user' => $user,
        'page_title' => 'Editare utilizator',
         'title' => 'Editare utilizator'));
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
        $this->validate($request, array(
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|max:255',
            'password'              => 'required|string|min:6|max:20|confirmed',
            'password_confirmation' => 'required|string|same:password',
            )
        );
        
        $user = User::find($id);
        $user->password = bcrypt($request->input('password'));
        $input = $request->all();
        $user->fill($input)->save();
 
        Session::flash('flash_message', 'Utilizator modificat!');
        return redirect()->route('users');
    }

    /**
     * Show the form for update password
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function updatepassword($id)
    {
        $user = User::find($id);
        return view('users.changepassword', array('user' => $user,
        'page_title' => 'Schimbare parola utilizator',
         'title' => 'Schimbare parola utilizator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function storepassword(Request $request, $id, MessageBag $message_bag)
    {
        $this->validate($request, array(
            'oldpassword'           => 'required|string|min:6|max:20',
            'password'              => 'required|string|min:6|max:20|confirmed',
            'password_confirmation' => 'required|string|same:password',
            )
        );
        
        $user = User::find($id);
        
        if (Hash::check($request->input('old_password'), $user->password)) {
            $input = $request->all();
            $user->fill($input)->save();
            Session::flash('flash_message', 'Utilizator modificat!');
            return redirect()->route('users');
        }
        else {
            $message_bag->add('password', 'Parola curenta nu este parola corecta curenta!');
            return redirect()->route('users')->withErrors($message_bag);
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
 
        $user->delete();
 
        Session::flash('flash_message', 'Utilizator anulat/sters!');
 
        return redirect()->route('users');
    }


    public function autocomplete(Request $request)
    {
        $term = $request->term;
    
        $queries = DB::table('users') //Your table name
            ->where('name', 'like', '%'.$term.'%') //Your selected row
            ->take(5)->get();
    
        foreach ($queries as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->name ]; //you can take custom values as you want
        }
        if(!isset($results))
        {
            $results[] = ['id' => 0, 'value' => "NA" ];
        }
        return response()->json($results);
    }

    public function autousername(Request $request, $medicid)
    {
        #$term = $request->term;
    
        $medic = User::findOrFail($medicid);
        $results[] = ['id' => $medic->id, 'value' => $medic->name]; //you can take custom values as you want

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
