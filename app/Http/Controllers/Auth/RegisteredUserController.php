<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AppUser;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'username' => ['required', 'string', 'max:255', 'unique:'.AppUser::class],
            'pronouns' => 'string',
            'level' => 'string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $pronouns = ($request->pronouns == 'unselected' 
                    || $request->pronouns == 'withheld'
                    || $request->pronouns == null) 
                    ? 'unselected' 
                    : $request->pronouns;

        $level = ($request->level == null) ? 'gamer' : $request->level;

        $appUser = new AppUser();
        $appUser->user_id = $user->id;
        $appUser->username = $request->username;
        $appUser->pronouns = $pronouns;
        $appUser->status = 'Checking this app out';
        $appUser->about = 'Hi! I am using this app!';
        $appUser->xp_count = 0;
        $appUser->last_online = $user->created_at;
        $appUser->level = $level;
        $appUser->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
