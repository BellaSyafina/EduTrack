@extends('layout.template-auth')

@section('content')
    <div class="login-main">
        <form class="theme-form" action="{{ route('login') }}" method="POST">
            @csrf
            <h4>Sign in to account</h4>
            <p>Enter your username & password to login</p>
            <div class="form-group">
                <label class="col-form-label">Username</label>
                <input class="form-control" type="text" required="" name="username" placeholder="Masukkan Username">
            </div>
            <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                    <input class="form-control" type="password" name="password" required=""
                        placeholder="*********">
                    <div class="show-hide"><span class="show"> </span></div>
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="form-check">
                </div>
                <a class="link" href="forgot-password.html">Forgot password?</a>
                <div class="text-end">
                    <button class="btn btn-primary btn-block w-100 mt-3" type="submit">Sign in</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const showHide = document.querySelector(".show-hide");
        const passwordInput = document.querySelector("input[name='password']");

        showHide.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.classList.add("active");
            } else {
                passwordInput.type = "password";
                this.classList.remove("active");
            }
        });
    });
</script>
@endpush
