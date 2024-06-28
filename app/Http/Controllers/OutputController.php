<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Output;
use App\Enums\OutputType;
use App\Models\JenisOutput;
use App\Models\JenisOutputKey;
use App\Models\StatusOutput;
use Illuminate\Http\Request;

class OutputController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $isAdminOrKaur = $user->hasRole('Admin') || $user->hasRole('Kaur');

        $query = Output::with([
            'penelitian' => function ($query) {
                $query->where('arsip', false);
            },
            'outputDetails' => function ($query) {
                $query
                    ->where('arsip', false)
                    ->with('authorOutputs.author.user');
            },
        ]);

        if ($isAdminOrKaur) {
            $query->whereHas('penelitian', function ($query) {
                $query->where('arsip', false);
            })->whereHas('outputDetails', function ($query) {
                $query->where('arsip', false);
            });
        } else {
            $query->with(['penelitian.users' => function ($query) use ($user) {
                $query->where('users.id', $user->id);
            }])->whereHas('penelitian', function ($query) {
                $query->where('arsip', false);
            })->whereHas('penelitian.users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->whereHas('outputDetails', function ($query) {
                $query->where('arsip', false);
            });
        }

        $output = $query->get();

        $jenis_output = JenisOutput::with([
            'jenisOutputKey' => function ($query) {
                $query->orderBy('name', 'asc');
            },
        ])->get();

        $jenis_output_key = JenisOutputKey::all();

        $status_output = StatusOutput::all();
        $tipe = OutputType::getValues();

        return view('output.index', compact('output', 'jenis_output', 'jenis_output_key', 'status_output', 'tipe'));
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
    public static function store(string $penelitian_id)
    {
        $output = Output::firstOrCreate(['penelitian_id' => $penelitian_id]);

        return $output;
    }

    /**
     * Display the specified resource.
     */
    public function show(Output $output)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Output $output)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Output $output)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Output $output)
    {
        //
    }
}
