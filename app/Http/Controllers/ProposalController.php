<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Emploi;
use App\Models\CoverLetter;
// use App\Http\Requests\StoreProposalRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProposalRequest;

class ProposalController extends Controller
{
    public function home()
    {
        $proposals = auth()->user()->proposals()->get();

        return view('home', compact('proposals'));
	}
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
    // public function store(StoreProposalRequest $request)
    public function store(Request $request, Emploi $emploi)
    {
        $request->validate([
            'coverLetter' => 'required|max:255' 
        ]);

        $proposal = Proposal::create([
            'emploi_id' => $emploi->id
        ]);
 
        CoverLetter::create([
            'proposal_id' => $proposal->id,
            'content' => $request->input('coverLetter')
        ]);
 
        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Emploi $emploi)
    {
        return view('proposals.submit', compact('emploi'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposal $proposal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProposalRequest $request, Proposal $proposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        //
    }
}
