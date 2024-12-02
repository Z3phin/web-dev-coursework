<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    
    /**
     * Display the specified resource.
     */
    public function show(AppUser $appUser)
    {
        return view('app_user.show', ['appUser' => $appUser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppUser $appUser)
    {
        
        if (Auth::user()->appUser != $appUser) {
            abort(403);
        }
        return view('app_user.edit', ['appUser' => $appUser]); 
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppUser $appUser)
    {

        if (Auth::user()->appUser != $appUser) {
            abort(403);
        }

        $request->validate([
            'username' => 'required|unique:app_users|string|max:255',
            'pronouns' => 'required|string|max:32',
            'level'    => 'required|string|max:32',
            'status'   => 'max:255',
            'about'    => 'max:65535', 
        ]);


        $appUser->username = $request->username; 
        $appUser->pronouns = $request->pronouns;
        $appUser->level = $request->level;
        $appUser->status = ($request->status == null) ? '': $request->status;
        $appUser->about = ($request->about == null) ? '': $request->about;
        $appUser->save();

        return redirect(route('appUser.show', ['appUser' => $appUser]));
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
