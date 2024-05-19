<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
// use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateConversationRequest;
use App\Models\Proposal;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ConversationController extends Controller
{ 

    use AuthorizesRequests; // Ajoutez ceci
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // Récupérer les conversations de l'utilisateur authentifié
      $conversations = auth()->user()->conversations()->latest()->get();
        
      // Passer les conversations à la vue
      return view('conversations.index', compact('conversations'));
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
    public function store(Request $request)
    {
        $proposal = Proposal::findOrFail(request('proposal'));
        $this->authorize('confirm', $proposal->emploi);
        $proposal->fill(['validated' => 1]);

        if ($proposal->isDirty()) {

            $proposal->save();

            $to = $proposal->user_id;
            $emploi = $proposal->emploi_id;
    
            $conversation = Conversation::create([
                'from' => auth()->user()->id,
                'to' => $to,
                'emploi_id' => $emploi
            ]);
    
            Message::create([
                'user_id' => auth()->user()->id,
                'conversation_id' => $conversation->id,
                'content' => "Bonjour, j'ai validé votre offre."
            ]);

            return redirect()->route('conversation.show', ['conversation' => $conversation]);
        } else {
            return redirect()->route('home');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        return view('conversations.show', compact('conversation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConversationRequest $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
