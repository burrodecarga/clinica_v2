<?php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Http\Requests\StoreEvidenceRequest;
use App\Http\Requests\UpdateEvidenceRequest;

class EvidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEvidenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvidenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function show(Evidence $evidence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function edit(Evidence $evidence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEvidenceRequest  $request
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvidenceRequest $request, Evidence $evidence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evidence  $evidence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evidence $evidence)
    {
        //
    }
}
