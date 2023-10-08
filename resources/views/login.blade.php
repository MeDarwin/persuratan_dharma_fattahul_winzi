<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Login Lettertantica</title>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card my-5">
                <form class="card-body cardbody-color p-lg-5" method="POST" action="{{ url('auth', ['login']) }}">
                    @csrf
                    <div class="text-center">
                        <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                            class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="150px"
                            alt="profile">
                    </div>
                    <div class="text-center display-3 mb-3">
                        Lettertantica
                    </div>
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" id="Username"
                            aria-describedby="username" placeholder="User Name">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="password">
                    </div>
                    @include('layout.flashMessage')
                    <div class="text-center"><button type="submit"
                            class="btn btn-primary px-5 mb-5 w-100">Login</button></div>
                </form>
            </div>

        </div>
    </div>
</div>
