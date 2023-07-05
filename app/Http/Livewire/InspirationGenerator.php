<?php

namespace App\Http\Livewire;

use App\Actions\InspirationGenerate;
use Livewire\Component;

class InspirationGenerator extends Component
{
    public $image;
    public $limit = 50;
    public $category;
    public $tags;

    public function mount() {
        $this->tags = json_decode(file_get_contents("https://api.waifu.im/tags"))->versatile;
        $this->category = $this->tags[0];
    }

    public function generate() {
        $this->image = InspirationGenerate::createAndSaveImage($this->limit, $this->category)[0];
    }

    public function render()
    {
        return view('livewire.inspiration-generator');
    }
}
