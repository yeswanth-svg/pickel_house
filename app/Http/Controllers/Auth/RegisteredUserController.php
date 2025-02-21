<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Referral;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'unique:' . User::class],
            'country' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'country' => $request->country,
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        // Check if a referral code was provided
        if ($request->filled('ref')) {
            $referrer = User::where('referral_code', $request->input('ref'))->first();
            if ($referrer) {
                $referral = new Referral();
                $referral->referrer_id = $referrer->id;
                $referral->referred_id = $user->id;
                $referral->referral_code = $request->input('ref');
                $referral->save();

            }
        }





        // Fire the event to send email verification
        event(new Registered($user));

        // ✅ Log in the user immediately after registration
        Auth::login($user);

        // Redirect to the email verification page
        return redirect(route('verification.notice'))->with('status', 'verification-link-sent');
    }


}
