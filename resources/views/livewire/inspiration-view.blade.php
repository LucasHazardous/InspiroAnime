<div class="py-12">

    <input type="text" class="form-control mb-4" placeholder="Search for inspirations..." wire:model.debounce.500ms="search">

    @foreach ($inspirations as $inspiration)
        <div class="card row mb-4">
            <div class="card-body">
                <div class="col-sm-6">
                    <p class="card-text"><i class="bi bi-link"></i> {{$inspiration->source}}</p>
                    <p class="card-text"><i class="bi bi-card-text"></i> {{$inspiration->text}}</p>
                    <p class="card-text"><i class="bi bi-clock"></i> {{$inspiration->created_at}}</p>
                    <p class="card-text"><a href="{{ route('inspirations.delete', ['inspiration' => $inspiration]) }}" class="btn btn-outline-danger"><i class="bi bi-trash"></i>Delete</a></p>
                </div>
            </div>
            <img src="/storage/{{$inspiration->image}}" alt="inspiration" class="rounded" style="max-height: 700px;object-fit: contain;" width="100%">
        </div>
    @endforeach

    {{ $inspirations->links() }}
</div>
