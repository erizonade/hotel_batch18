<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
</head>
<body>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    @if (session('status'))
                        <div class="alert alert-danger my-4">{{ session('status') }}</div>
                    @endif
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3>Login</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('proses-login') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="" class="col-md-2">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email anda">
                                        @error('email')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="" class="col-md-2">Password</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password anda">
                                        @error('password')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-info " type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.scripts')
</body>
</html>
