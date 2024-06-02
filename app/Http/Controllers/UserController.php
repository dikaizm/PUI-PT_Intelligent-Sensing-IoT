<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        $roles = Role::all()->pluck('name');

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserCreateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'nip' => $request->input('nip'),
            'email' => $request->input('email'),
            'telp' => $request->input('telp'),
            'keahlian' => $request->input('keahlian'),
            'link_google_scholar' => $request->input('link_google_scholar'),
            'link_sinta' => $request->input('link_sinta'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->assignRole($request->role);

        return redirect('/users')->with(
            'success',
            'User berhasil ditambahkan!'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserUpdateRequest $request,
        string $id
    ): RedirectResponse {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'telp' => $request->telp,
            'keahlian' => $request->keahlian,
            'fakultas' => $request->fakultas,
            'link_google_scholar' => $request->link_google_scholar,
            'link_sinta' => $request->link_sinta,
            'password' => $request->password
                ? Hash::make($request->password)
                : $request->input('password_old'),
        ]);

        $user->syncRoles([$request->role]);

        return redirect('/users')->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
