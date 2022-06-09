<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (Auth::check() && Auth::user()->type === "ADMIN"){
            return view("user.index");
        }else{
            //dd("not signedin");
            abort(404);
        }
       
    }

    public function getData(Request $request){
        //return "";

        //$data = User::query();
        //print_r($data);
        return Datatables::of(User::query())
        ->addIndexColumn()
        //  ->parameters([
        //      'dom' => 'Bfrtip',
        //      'buttons' => ['excel', 'pdf'],
        //   ])
         ->addColumn("action", function($datarow){
             return '<div class="row">
             <div class="col icons-option" >
             
             
             
             <a href="'. route("user.reset", 2) .'" ><i class="fa fa-refresh" aria-hidden="true"></i></a>
             </div>
             </div>
             
            
    '. csrf_field() .'
</form>
             
             ';
         })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {

        $authenticatedUser = Auth::user();
        if($authenticatedUser->id != $user->id && $authenticatedUser->type != 'ADMIN'){
            abort(404);
        }
        //$user = User::findOrFail(3);
        //dd($user);
        // if($user->id === null){
        //     dd("User is null");
        // }else{
        //    // $user = User::findOrFail(Au)
        // }
       //$user = User::findOrFail()
        return view("user.create_update", 
        [
            'actionMethod' => "view", 
            'actionDescription' => "View Record", 
            'alertType' =>'success', 
            'record' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //dd($user);
        $authenticatedUser = Auth::user();
        if($authenticatedUser->id != $user->id && $authenticatedUser->type != 'ADMIN'){
            abort(404);
        }
        //$user = User::findOrFail(Auth::user()->id);
        //dd($user);
        // if($user->id === null){
        //     dd("User is null");
        // }else{
        //    // $user = User::findOrFail(Au)
        // }
       //$user = User::findOrFail()
        return view("user.create_update", 
        [
            'actionMethod' => "edit", 
            'actionDescription' => "Edit Record", 
            'alertType' =>'success', 
            'record' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {

        $authenticatedUser = Auth::user();

        if($authenticatedUser->id != $user->id && $authenticatedUser->type != 'ADMIN'){
            //dd($authenticatedUser->id . " " . $authenticatedUser->type . " " . $request['id']);
            return view("user.create_update", 
            [
                'actionMethod' => "edit", 
                'actionDescription' => "Edit Record", 
                'alertType' =>'danger', 
                'confirmationMessage' => "You do not have admin previledge to update this user",
                'record' => Auth::user(),
            ]);
        }

        //dd($request['new_password']);
        $user = User::findOrFail($request['id']);
        //dd($user);
        $data = $request->validated();
         
        $user->type = $data['type'];
        $user->status = $data['status'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        
        //$user->new_password = $data['new_password'];
        //dd($user);

        
        if (Hash::check($user->password, $authenticatedUser->password)) {
            $user->password = Hash::make($data['new_password']);
            $varC = $user->save();
            //dd($varC);
            return view("user.create_update", 
            [
                'actionMethod' => "view", 
                'actionDescription' => "View Record", 
                'alertType' =>'success', 
                'confirmationMessage' => "User: " . $user->name . " account was updated successfully.",
                'record' => $user,
            ]);
        }else{
            //dd("Failed update");
            return view("user.create_update", 
            [
                'actionMethod' => "edit", 
                'actionDescription' => "Edit Record", 
                'alertType' =>'danger', 
                'confirmationMessage' => "Current user password didn't match to current user.",
                'record' => $user,
            ]);
        }
        //dd($user);
    }

    function resetUserPassword(User $user){
       // dd($user);

       $user->password = Hash::make("12348765");
       $user->save();

       return redirect()->route('dashboard.user')
        ->with([ 
         'confirmationMessage' =>'User:  ' . $user->name . " password was reseted succesfully. New Password: 12348765",
         'alertType' =>'success' 
         ]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
