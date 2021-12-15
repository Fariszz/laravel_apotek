<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\PaymentCheck;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->where('role_id','!=',1)->paginate(10);

        return view('dashboard.user.index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->where('id','!=',1);
        return view('dashboard.user.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // $validatedData =
        // dd($request);
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if($request->password){
            $passwordHash = Hash::make($request->password);
        }
        $user->password = $passwordHash;
        $user->role_id = 2;

        $user->save();

        // $validatedData['role_id'] = intval($validatedData['role_id']);
        // $validatedData['password'] = Hash::make($validatedData['password']);

        // dd($validatedData);
        // User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        // dd($user);
        User::find($user->id)->delete();

        return redirect()->route('users.index')->with('success', 'Deleted successfully!');
    }


  
}
