<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility ;
use Illuminate\Validation\Rule ;


class FacilityController extends Controller
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

        $facilities = Facility::query();

        if ($keyword = request('search')) {
            $facilities = $facilities->where('name', 'LIKE', "%$keyword%");
        }


        if ($keyword = request('order')) {
            if ($keyword == 'alphabet') {
                $facilities = $facilities->orderBy('name', 'ASC');
            }
        }

        $facilities = $facilities->paginate(10);

        return view('profile.admin.facility.all' , compact('facilities'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Facility $facility)
    {
        $data = $request->validate([
            'name' => ['required' , 'string', 'max:25' , Rule::unique('facilities')]
        ]);
        $facility->create($data);
        
        alert()->success( 'Facility Added', 'Facility Created Successfully');
        return redirect(route('admin.facilities.index')) ;
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        return  view('profile.admin.facility.edit' , compact('facility'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $data = $request->validate([
            'name' => ['required' , 'string', 'max:25' , Rule::unique('facilities')]
        ]);

        $facility->update($data);
        
        alert()->success( 'Facility Edited', 'Facility Edited Successfully');
        return redirect(route('admin.facilities.index')) ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        alert()->success( 'Delete Complete', 'Facility Deleted Successfully');
        return redirect(route('admin.facilities.index')) ;
    }
}
