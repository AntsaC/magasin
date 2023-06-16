<html lang="en"><head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Mikolo / Login </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Mikolo</h5>
                                </div>

                                <form class="row g-3 needs-validation" method="post" action="{{ route('login') }}" >
                                    @csrf
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="magasin@gmail.com" required="">
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" value="magasin" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required="">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="register">Create an account</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
        <p>Switch credentials (For dev environment only)</p>
        <div class="button-group">
            <button class="btn btn-secondary switch">Admin</button>
            <button class="btn btn-secondary switch">Tamatave</button>
            <button class="btn btn-secondary switch">Fianarantsoa</button>
            <button class="btn btn-secondary switch">Majunga</button>
        </div>
</main>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
        $(document).ready(function (){

            let array = [
                {
                    email: 'magasin@gmail.com',
                    password: 'magasin'
                },
                {
                    email: 'R1@gmail.com',
                    password: 'R1'
                },
                {
                    email: 'R2@gmail.com',
                    password: 'R2'
                },
                {
                    email: 'R3@gmail.com',
                    password: 'R3'
                },
            ]

            $(".switch").click(function ()  {
                $("#email").val(array[$(this).index()].email);
                $("#password").val(array[$(this).index()].password);
            })
        })
    </script>
</body>
</html>
