<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    @include('fumigator.includes.header')
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" src="{{asset('template/img/logo_prana.png')}}"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="{{ route('authenticate.login') }}" class="user" method="POST">
                                    {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nama"
                                                id="nama" aria-describedby="emailHelp @error('nama') is-invalid @enderror"
                                                placeholder="Masukan Nama Anda....." autofocus required value="{{ old('nama') }}">
                                                @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('fumigator.includes.script')

</body>

</html>