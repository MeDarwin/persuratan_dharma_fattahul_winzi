@if ($errors->any())
    <div class="position-absolute top-50 start-50 translate-middle z-3 w-75">
        <div class="alert alert-danger alert-dismissible">
            <h2 class="alert-heading border-bottom">Gagal!</h2>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @foreach ($errors->all() as $message)
                <p class="m-0 p-0"> {{ $message }}</p>
            @endforeach
        </div>
    </div>
@endif
