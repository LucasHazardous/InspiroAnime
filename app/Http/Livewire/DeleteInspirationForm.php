<?php

namespace App\Http\Livewire;

use App\Models\Inspiration;
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
        $this->inspiration->delete();

        return redirect()->route('inspirations.index');
    }

    public function render()
    {
        return view('livewire.delete-inspiration-form');
    }
}
