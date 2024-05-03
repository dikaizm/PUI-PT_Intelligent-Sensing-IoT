<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'telp' => $request->telp,
            'keahlian' => $request->keahlian,
            'fakultas' => $request->name,
            'link_google_scholar' => $request->link_google_scholar,
            'link_sinta' => $request->link_sinta,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
