<?php

namespace App\Http\Livewire;

use App\Models\Inspiration;
use Livewire\Component;

class InspirationView extends Component
{
    public function render()
    {
        return view('livewire.inspiration-view', [
            "inspirations" => Inspiration::paginate(2)->withQueryString()
        ]);
    }
}
