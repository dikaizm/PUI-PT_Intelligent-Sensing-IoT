<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'Dosen', 'Kaur']);
        })->get();

        $roles = Role::all()->pluck('name');

        return view('users.index', compact('users', 'roles'));
    }

    public function apiIndex()
    {
        return User::all();
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

    public function externalStore(Request $request): JsonResponse
    {
        // Validate the request to ensure 'name' is provided
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        // If validation fails, return a JSON response with errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if the user already exists
        if (User::where('name', $request->input('name'))->exists()) {
            return response()->json([
                'success' => true,
                'message' => 'exist'
            ], 200);
        }

        // Generate a UUID
        $uuid = Uuid::uuid4()->toString();

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $uuid . '@example.com',
            'password' => Hash::make($uuid),
        ]);

        // Return a JSON response with success message and user data
        return response()->json([
            'success' => true,
            'message' => 'Anggota external berhasil ditambahkan, silahkan pilih anggota tim anda!',
            'data' => $user
        ], 201);
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
