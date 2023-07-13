<?php

namespace App\Http\Livewire;

use App\Models\Inspiration;
use Livewire\Component;

class InspirationView extends Component
{
    public function render()
    {
        return view('livewire.inspiration-view', [
            "inspirations" => Inspiration::select("id", "creator", "created_at", "text", "source", "image")
            ->where("creator", auth()->user()->id)
            ->orderBy("created_at", "desc")
            ->paginate(2)
            ->withQueryString()
        ]);
    }
}
