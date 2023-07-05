<?php

namespace App\Http\Livewire;

use App\Models\Inspiration;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteInspirationForm extends Component
{
    public Inspiration $inspiration;

    public function mount(Inspiration $inspiration): void
    {
        $this->inspiration = $inspiration;
    }

    public function deleteInspiration()
    {
        if($this->inspiration->creator == auth()->user()->id) {
            Storage::disk("public")->delete($this->inspiration->image);
            $this->inspiration->delete();
        }

        return redirect()->route('inspirations.index');
    }

    public function render()
    {
        return view('livewire.delete-inspiration-form');
    }
}
