<?php

namespace App\Http\Livewire;

use App\Models\Inspiration;
use Livewire\Component;
use Livewire\WithPagination;

class InspirationView extends Component
{
    use WithPagination;

    public string $search = "";

    public function render()
    {
        return view('livewire.inspiration-view', [
            "inspirations" => Inspiration::select("id", "creator", "created_at", "text", "source", "image")
            ->where("creator", auth()->user()->id)
            ->orderBy("created_at", "desc")
            ->search("text", $this->search)
            ->paginate(2)
            ->withQueryString()
        ]);
    }
}
