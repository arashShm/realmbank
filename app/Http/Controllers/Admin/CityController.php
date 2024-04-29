<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule ;
use App\Models\City ;
use App\Models\Country;


class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:isAdmin');
    }


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('profile.admin.location.all');
        return redirect(route('admin.location.index')) ;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , City $city)
    {
        $data = $request->validate([
            'cityName' => ['required' , 'string', 'max:25' , Rule::unique('cities')],
            'country_id' => ['required']
        ]);

        $city = $city->create($data);
        $city->countries()->sync($data['country_id']);

        // $response = ['message' => 'City Created Successfully'];
        // return response()->json($response);
        alert()->success( 'Create Complete', 'City Created Successfully');
        return redirect(route('admin.location.index')) ;

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
