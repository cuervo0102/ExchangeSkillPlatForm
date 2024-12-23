<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'age' => 'required|integer|min:18|max:100',
        'date_of_entry' => 'required|date',
        'student_year' => 'required|string|in:1st Year,2nd Year,3rd Year,4th Year,5th Year',
        'field' => 'required|string|in:Genie Civil,Genie Informatique,Genie Industriel,Prepa First Year,Prepa Second Year',
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users',
            function ($attribute, $value, $fail) {
                if (!str_ends_with($value, '@emsi-edu.ma')) {
                    $fail('The email must be in the format @emsi-edu.ma.');
                }
            },
        ],
        'password' => 'required|string|confirmed|min:8',
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'age' => $request->age,
        'date_of_entry' => $request->date_of_entry,
        'student_year' => $request->student_year,
        'field' => $request->field,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('verification.notice');
}

}
