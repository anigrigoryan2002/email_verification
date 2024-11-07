<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        // $user = Auth::user(); 
        dd($request);
        // return view('profile', compact('user')); 
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'required|string',
            'avatar' => 'NULL|image|mimes:jpeg,png,jpg,gif',
            'current_password' => 'required|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', __('Current password is incorrect.'));
        }

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }

            // Store new avatar
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Update password if new password is provided
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('status', __('Profile updated successfully!'));
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed|min:8',
        ]);

        $user = auth()->user();

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->input('new_password'));
            $user->save(); 

            return redirect()->back()->with('status', 'Password changed successfully!');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
    }
}
