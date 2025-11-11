@extends('layout.template-auth')

@section('content')
    <div class="login-main">
        <form class="theme-form">
            <h4>Sign in to account</h4>
            <p>Enter your username & password to login</p>
            <div class="form-group">
                <label class="col-form-label">Username</label>
                <input class="form-control" type="email" required="" placeholder="Masukkan Username">
            </div>
            <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                    <input class="form-control" type="password" name="login[password]" required=""
                        placeholder="*********">
                    <div class="show-hide"><span class="show"> </span></div>
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="form-check">
                    <input class="checkbox-primary form-check-input" id="checkbox1" type="checkbox">
                    <label class="text-muted form-check-label" for="checkbox1">Remember password</label>
                </div><a class="link" href="forgot-password.html">Forgot password?</a>
                <div class="text-end">
                    <button class="btn btn-primary btn-block w-100 mt-3" type="submit">Sign in</button>
                </div>
            </div>
        </form>
    </div>
@endsection
