<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User ;
use Illuminate\Validation\Rule ;

class ProfileController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:isAdmin');
    }


    public function index()
    {
        return view('profile.admin.profile');
    }


}
