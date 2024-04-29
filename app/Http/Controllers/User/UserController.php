<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule ;


class UserController extends Controller
{
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('profile.user.user.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'firstName' => [ 'sometimes','string' , 'max:255'] ,
            'lastName' => ['sometimes','string' , 'max:255'] ,
            'email' => ['sometimes','email' , 'max:255' , Rule::unique('users')->ignore($user->id)] ,
            'phone' => ['sometimes','max:11'],
            'role' => ['sometimes','in:admin,consultant,user'],
            'password' => ['sometimes', 'min:8', 'confirmed'],
        ]);

        if(! is_null($request->password)){
            $data['password'] = $request->password ;
        }

        $user->update($data);

        alert()->success( 'Edit Complete', 'Your information is Edited Successfully');
        return redirect(route('profile')) ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        auth()->logout();
        $user->delete();
        return redirect(route('home')) ;
    }
}
