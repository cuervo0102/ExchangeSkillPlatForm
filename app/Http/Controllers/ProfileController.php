<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'age' => 'required|integer|min:1|max:150',
        'date_of_entry' => 'required|date',
        'student_year' => 'required|string|max:255',
        'field' => 'required|string|max:255',
    ]);

    $user = auth()->user();

    if ($request->hasFile('profile_picture')) {
        // Delete existing profile picture if it exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store the new profile picture
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        $user->profile_picture = $path;
    }

    // Update user information
    $user->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'age' => $request->age,
        'date_of_entry' => $request->date_of_entry,
        'student_year' => $request->student_year,
        'field' => $request->field,
    ]);

    return back()->with('success', 'Profile updated successfully.');
}


    public function destroy(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile picture if it exists
        if ($user->profile_picture_url) {
            Storage::disk('public')->delete($user->profile_picture_url);
        }

        Auth::logout();
        $user->delete();

        return redirect()->route('login')->with('success', 'Account deleted successfully.');
    }
}