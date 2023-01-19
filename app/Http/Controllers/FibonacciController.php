<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\CountFibonacci;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Fibonacci;

class FibonacciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["data" => DB::table('jobs')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'number' => 'required|numeric|min:1',
            ]
        );

        if ($validator->fails()) {
            return $validator->errors()->all();
        }
        $fibonacciData = Fibonacci::create([
            "number" => $request->number,
            "status" => "pending",
            "result" => 0,
        ]);
        $job = new CountFibonacci($fibonacciData);
        // CountFibonacci::dispatch($validatedData);
        $this->dispatch($job);
        return response()->json(['message' => $fibonacciData->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(["data" => DB::table('fibonaccis')->where('id', $id)->first()]);
    }
    
}
