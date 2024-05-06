<?php

namespace App\Http\Controllers;

use App\Models\PublisherKey;
use App\Http\Requests\PublisherKeyRequest;

class PublisherKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublisherKeyRequest $request)
    {
        PublisherKey::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('publisher.index')
            ->with('success', 'key berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PublisherKey $publisherKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PublisherKey $publisherKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherKeyRequest $request, string $id)
    {
        PublisherKey::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('publisher.index')
            ->with('success', 'key berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PublisherKey::findOrFail($id)->delete();

        return redirect()
            ->route('publisher.index')
            ->with('success', 'Key berhasil dihapus!');
    }
}
