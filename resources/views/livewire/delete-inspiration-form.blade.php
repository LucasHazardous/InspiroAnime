<div class="py-12">
    <form wire:submit.prevent="deleteInspiration">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Do you want to delete it?</h5>
            </div>
            <div class="card-body">
                <img src="/storage/{{$inspiration->image}}" alt="inspiration" class="rounded" style="max-height: 700px;object-fit: contain;" width="100%">
            </div>
            
            <div class="card-footer d-flex flex-column justify-content-end gap-1 d-sm-flex flex-sm-row">
                <a href="{{ route('inspirations.index') }}" class="btn btn-sm btn-outline-dark"><i
                        class="bi bi-arrow-90deg-left mr-1"></i>No, back</a>
                <button class="btn btn-sm btn-outline-danger">Yes, delete</button>
            </div>
        </div>
    </form>
</div>
