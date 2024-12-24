<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Models\User;

class UserInterestController extends Controller
{
    /**
     * Show the form for the user to select their interests.
     */
    public function showInterestForm()
    {
        // Fetch all available interests
        $interests = Interest::all();

        // Return a view with the interests data
        return view('user.interests', compact('interests'));
    }

    /**
     * Save the user's selected interests.
     */
    public function saveInterests(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'interests' => 'required|array',
            'interests.*' => 'exists:interests,id',
        ]);

        $user->interests()->sync($validated['interests']);

        return redirect()->route('dashboard')
            ->with('success', 'Your interests have been updated successfully!');
    }

    public function getInterestsByField($field)
    {
        $interests = Interest::where('field', $field)
            ->select('id', 'interest')
            ->get();

        return response()->json($interests);
    }

}
