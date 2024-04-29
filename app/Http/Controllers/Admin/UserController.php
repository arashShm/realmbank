<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule ;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:isAdmin');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = User::query();

    
        if($keyword = request('search')){
            $users = $users->where('email' , 'LIKE' , "%$keyword%")->orWhere('firstName' , 'LIKE' , "%$keyword%")->orWhere('lastName' , 'LIKE' , "%$keyword%");
        }
        
        if($keyword = request('order')){
            if($keyword == 'recent'){
                $users = $users->orderBy('created_at', 'DESC');
            }elseif($keyword == 'role'){
                $users = $users->orderByRaw("CASE WHEN role = 'admin' THEN 'admin' WHEN role ='consultant' THEN 'consultant' ELSE 'user' END ");
            }elseif($keyword == 'alphabet'){
                $users = $users->orderBy('lastName' , 'ASC');
            }
        }

        $users = $users->paginate(10);
        return view('profile.admin.user.all' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
        $data = $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['nullable' ,'string' , 'max:11'] ,
                'role' => ['required' ,'in:admin,consultant,user'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]) ;


        $user = User::create($data);

        // if($request->has('verify')){
        //     $user->markEmailAsVerified();
        // }
        alert()->success( 'User Added', 'User Created Successfully');
        return redirect(route('admin.users.index')) ;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return  view('profile.admin.user.edit' , compact('user'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,User $user)
    {
        
        $data = $request->validate([
            'firstName' => [ 'sometimes','required','string' , 'max:255'] ,
            'lastName' => ['sometimes','required','string' , 'max:255'] ,
            'email' => ['sometimes','required','email' , 'max:255' , Rule::unique('users')->ignore($user->id)] ,
            'phone' => ['sometimes','max:11'],
            'role' => ['sometimes','required','in:admin,consultant,user'],
        ]);

        if(! is_null($request->password)){
            $request->validate([
            'password' => ['sometimes','required','string', 'min:8', 'confirmed'],
            ]);
            $data['password'] = $request->password ;
        }
     

        
        if($request->has('verify')){
            $user->markEmailAsVerified();
        }

        $user->update($data);

        alert()->success( 'Edit Complete', 'User Edited Successfully');
        return redirect(route('admin.users.index')) ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        $user->delete();
        alert()->success( 'Delete Complete', 'User Deleted Successfully');
        return redirect(route('admin.users.index')) ;
    }
}
