<div>
    <div class="card" style="flex-direction: row;">
        <div class="row card-body" style="width:100%;">
            <div class="col-sm-6">
                <form wire:submit.prevent="generate">
                    <select wire:model="category" class="mb-3 form-control">
                        @foreach ($tags as $tag)
                        <option value="{{$tag}}">{{$tag}}</option>
                        @endforeach
                    </select>
                    <input type="text" wire:model="limit" class="mb-3 form-control">
                    <button class="btn btn-outline-primary mb-3">Generate</button>
                </form>
            </div>
        </div>
        @if (!is_null($image))
            <img src="/storage/{{$image}}" alt="inspiration" style="max-height: 800px;object-fit: contain;" width="100%">
        @endif
    </div>
</div>