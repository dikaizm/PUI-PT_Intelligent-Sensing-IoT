<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Output;
use App\Enums\OutputType;
use App\Models\JenisOutput;
use App\Models\StatusOutput;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $ROWS_PER_PAGE = 5;

    //     $user = auth()->user();
    //     $isAdmin = $user->hasRole('Admin');

    //     $query = Output::with([
    //         'penelitian' => function ($query) {
    //             $query->where('arsip', false);
    //         },
    //         'outputDetails' => function ($query) {
    //             $query->where('arsip', false);
    //         },
    //     ]);

    //     if ($isAdmin) {
    //         $query->whereHas('penelitian', function ($query) {
    //             $query->where('arsip', false);
    //         })->whereHas('outputDetails', function ($query) {
    //             $query->where('arsip', false);
    //         });
    //     } else {
    //         $query->with(['penelitian.users' => function ($query) use ($user) {
    //             $query->where('users.id', $user->id);
    //         }])->whereHas('penelitian', function ($query) {
    //             $query->where('arsip', false);
    //         })->whereHas('penelitian.users', function ($query) use ($user) {
    //             $query->where('users.id', $user->id);
    //         })->whereHas('outputDetails', function ($query) {
    //             $query->where('arsip', false);
    //         });
    //     }

    //     $output = $query->paginate($ROWS_PER_PAGE);

    //     $currPage = $output->currentPage();
    //     $startNumber = 1 + ($currPage - 1) * $ROWS_PER_PAGE;

    //     $jenis_output = JenisOutput::with([
    //         'jenisOutputKey' => function ($query) {
    //             $query->orderBy('name', 'asc');
    //         },
    //     ])->get();

    //     $status_output = StatusOutput::all();
    //     $tipe = OutputType::getValues();

    //     return view('output.index', compact('output', 'jenis_output', 'status_output', 'tipe', 'startNumber'));
    // }


    public function index()
    {
        $user = auth()->user();
        $isAdmin = $user->hasRole('Admin');

        $query = Output::with([
            'penelitian' => function ($query) {
                $query->where('arsip', false);
            },
            'outputDetails' => function ($query) {
                $query->where('arsip', false);
            },
        ]);

        if ($isAdmin) {
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

        $status_output = StatusOutput::all();
        $tipe = OutputType::getValues();

        return view('output.index', compact('output', 'jenis_output', 'status_output', 'tipe'));
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
