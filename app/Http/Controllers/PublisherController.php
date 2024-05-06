<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Requests\PublisherRequest;
use App\Models\PublisherKey;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan-publisher.index', [
            'publisher' => Publisher::with('publisherKey')->get(),
            'publisher_key' => PublisherKey::all(),

        ]);
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
    public function store(PublisherRequest $request)
    {
        Publisher::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('publisher.index')
            ->with('success', 'Publisher berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherRequest $request, string $id)
    {
        Publisher::where('id', $id)->update(['name' => $request->name]);

        return redirect()
            ->route('publisher.index')
            ->with('success', 'Publisher berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Publisher::findOrFail($id)->delete();

        return redirect()
            ->route('publisher.index')
            ->with('success', 'Publisher berhasil dihapus!');
    }
}
