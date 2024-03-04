<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:isAdmin');
    }


    public function index()
    {
        return 'hello';
    }
}
