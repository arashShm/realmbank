<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule ;
use App\Models\Country ;

class CountryController extends Controller
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
        //
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
    public function store(Request $request , Country $country)
    {

        $data = $request->validate([
            'countryName' => ['required' , 'string', 'max:25' , Rule::unique('countries')]
        ]);

        $country->create($data);
        
        alert()->success( 'Country Added', 'Country Created Successfully');
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
