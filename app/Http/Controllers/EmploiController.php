<?php

namespace App\Http\Controllers;

use App\Models\Emploi;
use App\Http\Requests\StoreEmploiRequest;
use App\Http\Requests\UpdateEmploiRequest;

class EmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Emploi::online()->latest()->get();
        return view('jobs.index', compact('jobs'));
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
    public function store(StoreEmploiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Emploi $emploi)
    {
        return view('jobs.show', compact('emploi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emploi $emploi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmploiRequest $request, Emploi $emploi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emploi $emploi)
    {
        //
    }
}
