<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class LocationController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:isAdmin');
    }


    public function index()
    {
        $countries = Country::query();

        if ($keyword = request('search')) {
            $countries = $countries->where('countryName', 'LIKE', "%$keyword%");
        }


        if ($keyword = request('order')) {
            if ($keyword == 'alphabet') {
                $countries = $countries->orderBy('countryName', 'ASC');
            }
        }


        $countries = $countries->paginate(5);
        return view('profile.admin.location.all', compact('countries'));


    }

    

    public function create()
    {
        return view('profile.admin.location.create');
    }
}
