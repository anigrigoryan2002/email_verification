<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }



    /**
     * Show the user's profile.
     */
    public function show(): View
    {
        $user = Auth::user(); // Get the authenticated user
        return view('profile.show', compact('user')); // Pass user data to the view
    }

    /**
     * Update the user's profile information.
     */

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:15',
            'gender' => 'required|string|in:male,female',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);
    
        $user = auth()->user();
        $isChanged = false;
    
        // Update user details
        $userData = $request->only('name', 'email', 'phone', 'gender');
    
        foreach ($userData as $key => $value) {
            if ($user->$key !== $value) {
                $user->$key = $value;
                $isChanged = true;
            }
        }
    
        // Handle avatar upload
          if ($request->hasFile('avatar')) {
            if ($user->avatar && $user->avatar !== null) {
                Storage::delete($user->avatar);
            }

            $path = $request->file('avatar')->move('public/images');
            // dd($path);
            $user->avatar = $path; 
            $isChanged = true;
        }
        // if ($request->hasFile('avatar')) {
        //     Log::info('Avatar file:', [$request->file('avatar')->getClientOriginalName()]);
        // }
        if ($isChanged) {
            $user->save();
            return redirect()->back()->with('status', 'Profile updated successfully!');
        }
    
        return redirect()->back()->with('status', 'No changes made.');
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        
        // Check if the old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The provided password does not match our records.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
