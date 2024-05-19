<?php

namespace App\Livewire;
use App\Models\Message;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class Conversation extends Component
{
    use AuthorizesRequests;
    
    public $conversation;
    public $emploi;
    public $message;
    protected $listeners = ['sent' => '$refresh'];

    public function mount($conversation)
    {
        $this->conversation = $conversation;
        $this->emploi = $conversation->emploi;
        $this->authorize('view', [$this->emploi, $this->conversation]);
    }

    public function sendMessage()
    {
        if($this->checkSpam()) {
            Message::create([
                'user_id' => auth()->user()->id,
                'conversation_id' => $this->conversation->id,
                'content' => $this->message
            ]);
    
            $this->message = '';
            $this->dispatch('sent');
        }
        
    }

    private function checkSpam()
    {
        $response = Message::whereBetween('created_at', [\Carbon\Carbon::now()->subMinutes(1)->toDateTimeString(), \Carbon\Carbon::now()])->where('user_id', auth()->user()->id)->get();
        
        if (!$response->isEmpty()) {
            $this->dispatch('flash-message', 'Vous ne pouvez pas poster plus d\'un message par minute', 'warning');
            return false;
        } else {
            return true;
        }
    }

    public function render()
    {
        return view('livewire.conversation');
    }
}
