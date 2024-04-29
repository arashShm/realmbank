<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth' , 'verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $properties = Property::query();

        if (request('contract')) {
            if (request('contract') == 'sale') {
                $properties = $properties->where('contract', 'LIKE', "sale");
            } elseif (request('contract') == 'rent') {
                $properties = $properties->where('contract', 'LIKE', "rent");
            }
        }
        if ($keyword = request('search')) {
            $properties = $properties->where('description', 'LIKE', "%$keyword%")->orWhere('plot', 'LIKE', "%$keyword%");
        }

        if ($keyword = request('plot')) {
            $properties = $properties->where('plot', $keyword);
        }

        if ($keyword = request('rooms')) {
            $properties = $properties->where('rooms', $keyword);
        }

        $properties = $properties->paginate(12);

        return view('home', compact('properties'));
    }


    public function showProperty(Property $property)
    {
        return view('show' , compact('property'));
    }

}
