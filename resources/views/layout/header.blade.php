<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark py-2">
    <div class="container-fluid mx-5">
        <div class="text-center d-flex align-items-center column-gap-1 me-3">
            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="40px" alt="profile">
            <a class="navbar-brand" href="{{ url("dashboard") }}">Lettertantica</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse align-items-center" id="navbarCollapse">
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    @if (Auth::user()["role"] === "admin")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url("surat", ["jenis"]) }}">Jenis surat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url("user") }}">User</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url("/surat") }}">Transaksi surat</a>
                    </li>
                </ul>
                <div class="row align-items-center column-gap-5">
                    <div class="col-auto text-white">
                        <div class="row w-auto fs-5">Hello, {{ Auth::user()["username"] }}</div>
                        <div class="row w-auto fs-6 text-capitalize">{{ Auth::user()["role"] }}</div>
                    </div>
                    <div class="col">
                        <a class="btn btn-sm btn-outline-danger" href="{{ url("auth", ["logout"]) }}" type="button">Logout</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
