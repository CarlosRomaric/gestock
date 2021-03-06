<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\User;
use App\Technicien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct($value='')
    {
        $this->middleware('auth');
        Cart::destroy();
    }

    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required']
        ]);
    }

    protected $messages = [
        'required'=>'le champ :attribute est requis',
        'unique:users'=>'cet utilisateur existe déjà dans la base de donnée'
    ];

    protected $rules = [
        // 'name' => ['required', 'string', 'max:255'],
        // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'role' => ['required']
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $techniciens = Technicien::listeTechniciens();
        $data = [
            'users'=>User::orderBy('created_at','desc')->get(),
            'techniciens'=>$techniciens
        ];
        return view('user/index')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $techniciens = Technicien::listeTechniciens();
        $data = [
            'techniciens'=>$techniciens
        ];
        return view('user/create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //$this->validator($request->all())->validate();
            $this->validate($request, $this->rules, $this->messages);
            //dd(User::getVerifyUserExist($request));
            if(User::getVerifyUserExist($request)){
               return back()->with('danger','Cet compte utilisateur a déja été créer');
            }
            $technicien = Technicien::find($request->technicien_id);

            //dd($technicien);
            $user = new User;
            $user->name = $technicien->nom.' '.$technicien->prenoms;
            $user->email = $technicien->email;
            $user->contacts = $technicien->contacts;
            $user->matricule = $technicien->matricule;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            //dd($user);
            $user->save();
            return redirect('/user')->with('success','vous avez créer un nouvel utilisateur');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user = User::find($id);
         //dd($user);
         $data = [
             'user'=>$user,
        ];
        return view('user/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules, $this->messages);
        $data = User::getRequest($request);
        $user = User::find($id);
        if(!empty($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return redirect('user')->with('message','les informations de l\'utilisateur ont  bien été modifiées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
