<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Candidate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $candidate = $user->candidate; // may be null if not created yet

        $applications = $candidate
            ? $candidate->applications()->with('job')->latest()->get()
            : collect();

        return view('profile.edit', [
            'user'         => $user,
            'candidate'    => $candidate,
            'applications' => $applications,
        ]);
    }

    /**
     * Update the user's account info (name/email) AND candidate profile info.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // 1) Update basic account info (name, email) - validated by ProfileUpdateRequest
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // 2) Validate + update candidate profile info
        $data = $request->validate([
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'bio'              => 'nullable|string|max:2000',
            'cv'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $candidate = $user->candidate;
        $cvPath = $candidate->cv ?? null;

        if ($request->hasFile('cv')) {
            // delete the old CV file if a new one was uploaded
            if ($cvPath) {
                Storage::disk('public')->delete($cvPath);
            }
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        Candidate::updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone'            => $data['phone'] ?? null,
                'address'          => $data['address'] ?? null,
                'experience_years' => $data['experience_years'] ?? null,
                'bio'              => $data['bio'] ?? null,
                'cv'               => $cvPath,
            ]
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        // clean up the CV file from disk if it exists
        if ($user->candidate && $user->candidate->cv) {
            Storage::disk('public')->delete($user->candidate->cv);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}