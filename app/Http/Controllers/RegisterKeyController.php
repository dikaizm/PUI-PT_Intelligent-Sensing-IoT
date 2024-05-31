<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\RegisterKey;
use Illuminate\Http\Request;

class RegisterKeyController extends Controller
{
    public function index()
    {
        return view('admin.register-key', [
            'register_keys' => RegisterKey::all(),
        ]);
    }

    public function newUlid()
    {
        $newUlid = \Ramsey\Uuid\Ulid::generate()->toRfc4122();

        $registerKey = new RegisterKey();

        $registerKey->id = $newUlid;
        $registerKey->save();

        return $newUlid;
    }

    public function newKey(string $id)
    {
        $newUlid = Uuid::uuid4()->toString();

        $registerKey = RegisterKey::find($id);

        if ($registerKey) {
            $registerKey->key = $newUlid;
            $registerKey->save();

            return redirect()
                ->route('register-key.index')
                ->with('success', 'Key berhasil diupdate! ' . $newUlid);
        } else {
            return redirect()
                ->route('register-key.index')
                ->with('error', 'RegisterKey with ID ' . $id . ' not found.');
        }
    }
}
