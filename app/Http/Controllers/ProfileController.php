<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;


class ProfileController extends Controller
{
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
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'profile_title' => 'required|string|max:255',
            'profile_summary' => 'nullable|string|max:8000',
        ]);

        $formData = new Profile();
        $formData->profile_title = $validatedData['profile_title'];
		if(empty($validatedData['profile_summary'])){
            $formData->profile_summary = 'No Summary';
        }else{
            $formData->profile_summary = $validatedData['profile_summary'];  
        }
        $formData->image = "Default image";
		$formData->user_id = Auth::id();
		$formData->save();		
		$newProfileID = $formData->id;
		
		//Get just created profile record
		$edit = Profile::where('id', $newProfileID)->get();
                
		
		// Redirect or return response
        return view('profile.create', compact('edit'))->with('success','Profile created successfully!');
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
    public function edit(int $id)
    {
        $edit = Profile::where('id', $id)->get();
        return view('profile.create', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {       
        
        // Validate the request data
        $validatedData = $request->validate([
            'profile_title' => 'required|string|max:255',
            'profile_summary' => 'nullable|string|max:8000',        
        ]);

        // Find the user by ID
        $profileItems = Profile::find($id);
        $profileItems->update($validatedData); 

        return redirect()->route('profile.create')->with('success', 'Profile updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
