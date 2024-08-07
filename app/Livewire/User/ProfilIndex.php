<?php

namespace App\Livewire\User;

use Livewire\Component;

class ProfilIndex extends Component
{
    public function render()
    {
        return view('livewire.user.profil-index')->title('Profil');
    }
}
