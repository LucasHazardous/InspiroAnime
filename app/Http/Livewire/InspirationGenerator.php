<?php

namespace App\Http\Livewire;

use App\Actions\InspirationGenerate;
use App\Models\Inspiration;
use Livewire\Component;

class InspirationGenerator extends Component
{
    public $image;
    public $limit = 50;
    public $category;
    public $tags;

    protected function rules() {
        return [
            "limit" => ["required", "integer", "gte:5", "lte:100"],
            "category" => ["required", "string", "in:" . implode(",", $this->tags)]
        ];
    }

    public function updated($field): void
    {
        $this->validateOnly($field, $this->rules());
    }

    public function mount() {
        $this->tags = json_decode(file_get_contents("https://api.waifu.im/tags"))->versatile;
        $this->category = $this->tags[0];
    }

    public function generate() {
        $formData = $this->validate($this->rules());

        $res = InspirationGenerate::createAndSaveImage($formData['limit'], $formData ['category']);
        
        $this->image = $res[0];

        Inspiration::create([
            "creator" => auth()->user()->id,
            "image" => $res[0],
            "text" => $res[1],
            "source" => $res[2]
        ]);
    }

    public function render()
    {
        return view('livewire.inspiration-generator');
    }
}
