@extends('layouts.auth')

@section('title', 'Register')

@section('content')
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Register Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="name" id="inputName" type="text"
                                                        placeholder="Enter your name" />
                                                    <label for="inputName">Full name</label>
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger alert-dismissible fade show mb-1">
                                                        {{ $message }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="email" id="inputEmail"
                                                        type="email" placeholder="name@example.com" />
                                                    <label for="inputEmail">Email address</label>
                                                </div>
                                                @error('email')
                                                    <div class="alert alert-danger alert-dismissible fade show mb-1">
                                                        {{ $message }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="password" id="inputPassword"
                                                        type="password" placeholder="Create a password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                @error('password')
                                                    <div class="alert alert-danger alert-dismissible fade show mb-1">
                                                        {{ $message }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="password_confirmation"
                                                        id="inputPasswordConfirm" type="password"
                                                        placeholder="Confirm password" />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                </div>
                                                @error('password_confirmation')
                                                    <div class="alert alert-danger alert-dismissible fade show mb-1">
                                                        {{ $message }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit"
                                                    class="btn btn-primary btn-block">Register Account</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
@endsection
