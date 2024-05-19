<?php

namespace App\Livewire;

use Livewire\Component;

class Emploi extends Component
{
    public $emploi;

    public function mount($emploi)
    {
        $this->emploi = $emploi;
    }

    public function like()
    {
        if ($this->isAuth()) {
            auth()->user()->likes()->toggle($this->emploi->id);
        } else {
            $this->dispatch('flash-message', 'Merci de vous connecter pour ajouter une mission dans vos favoris.', 'error');
            return;
        }
    }

    public function render()
    {
        return view('livewire.emploi', [
            'emploi' => $this->emploi
        ]);
    }

    private function isAuth()
    {
        return auth()->check();
    }

}

