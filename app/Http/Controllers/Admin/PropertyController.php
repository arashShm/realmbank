<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Country;

class PropertyController extends Controller
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
        $properties = Property::query();

        if($keyword = request('search')){
            $properties = $properties->where('description' , 'LIKE' , "%$keyword%")->orWhere('contract' , 'LIKE' , "%$keyword%")->orWhere('plot' , 'LIKE' , "%$keyword%");
        }
        
        if($keyword = request('order')){
            if($keyword == 'recent'){
                $properties = $properties->orderBy('created_at', 'DESC');
            }elseif($keyword == 'active'){
                $properties = $properties->where('status' , 'LIKE' , 'active');
            }elseif($keyword == 'expired'){
                $properties = $properties->where('status' , 'LIKE' , 'expired');
            }elseif($keyword == 'expire_date'){
                $properties = $properties->orderBy('expires_at', 'DESC');
            }
        }

        $properties = $properties->paginate(10);
        return view('profile.admin.property.all' , compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('profile.admin.property.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Property $property)
    {


        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg', 'max:1024'],
            'area' => ['required', 'max:225'],
            'plot' => ['required', 'max:30'],
            'user_id' => ['required'],
            'rooms' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'country_id' => ['required', 'integer'],
            'city_id' => ['required', 'integer'],
            'region' => ['required', 'string', 'max:60'],
            'expires_at' => ['required', 'date' , 'after:now'],
            'contract' => ['required', 'in:sale,rent'],
            'facility_id' => ['required', 'array'],
            'description' => ['required' , 'string']
        ]);

        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }

        $property = $property->create($data);
        $property->facilities()->sync($data['facility_id']);
        alert()->success('Property Created', 'Property Created Successfully');
        return redirect(route('admin.properties.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return view('profile.admin.property.show' , compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $countries = Country::all();
        $existingSelectedValues = $property->facilities()->pluck('id')->toArray();
        return view('profile.admin.property.edit' , compact('property' , 'countries' , 'existingSelectedValues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $data = $request->validate([
            'image' => [ 'image', 'mimes:jpg,jpeg', 'max:1024'],
            'area' => ['sometimes', 'max:225'],
            'plot' => ['sometimes', 'max:30'],
            'user_id' => ['sometimes'],
            'rooms' => ['sometimes', 'integer'],
            'price' => ['sometimes', 'numeric'],
            'country_id' => ['sometimes', 'integer'],
            'city_id' => ['sometimes', 'integer'],
            'region' => ['sometimes', 'string', 'max:60'],
            'expires_at' => ['sometimes', 'date' , 'after:now'],
            'contract' => ['sometimes', 'in:sale,rent'],
            'facility_id' => ['sometimes', 'array'],
            'status' => ['sometimes', 'in:active,sold,expired'],
            'description' => ['sometimes' , 'string']
        ]);

        if (isset($data['image']) && $data['image']) {
            $data['image'] = upload($data['image']);
        }

  
        if (isset($data['facility_id'])) {
            $property->facilities()->sync($data['facility_id']);
        } else {
            $property->facilities()->detach(); // If no facilities are selected, detach all existing facilities
        }

        $property = $property->update($data);
        // $property->facilities()->sync($data['facility_id']);
        alert()->success('Property Edited', 'Property Edited Successfully');
        return redirect(route('admin.properties.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        deleteFile($property->image);
        $property->delete();
        alert()->success('Property Deleted Successfully' , 'Delete Complete');
        return redirect(route('admin.properties.index')) ;
    }


    public function getCities($countryId)
    {
        $country = Country::find($countryId);
        $cities = $country->cities;

        return response()->json($cities);
    }
}
