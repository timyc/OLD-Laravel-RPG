@extends('layouts.external')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Updates & News
                </div>
                <div id="news" class="card-body">
                </div>
                <div class="row mb-3">
                    <div class="col">

                    </div>
                    <div class="col text-center">
                        <div id="pagination"></div>
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="min-width: 400px !important">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br />
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="register_name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="register_name" type="text" class="form-control @error('register_name') is-invalid @enderror" name="register_name" value="{{ old('register_name') }}" required autocomplete="name" autofocus>

                                @error('register_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="register_email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="register_email" type="email" class="form-control @error('register_email') is-invalid @enderror" name="register_email" value="{{ old('register_email') }}" required autocomplete="email">

                                @error('register_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="register_password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="register_password" type="password" class="form-control @error('register_password') is-invalid @enderror" name="register_password" required autocomplete="new-password">

                                @error('register_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="register_password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col offset-md-4">
                                <input id="terms" type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" name="terms">
                                <label class="form-check-label" for="terms"><span style="color: #66aaaa !important">I agree to the</span> <a href="/terms" target="_blank">Terms and Conditions</a></label>
                                @error('terms')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#pagination').pagination({
        dataSource: '{{ route('get-news') }}',
        locator: 'items',
        totalNumberLocator: function(response) {
            return response.total;
        },
        pageSize: 3,
        className: 'paginationjs-theme-blue',
        ajax: {
            beforeSend: function() {
                document.getElementById('news').innerHTML = '<div class = "row" style="padding: 22px 0 19px;"><div class="col">Loading...</div></div>';
            }
        },
        callback: function(response) {
            let dataHtml = '';

            $.each(response, function (index, item) {
                let post = '<p>' + item.content + '</p>';
                post = '<span class="admin">by <strong class="brown">'+ item.name +'</strong> on  '+ item.start_time +'</span>' + post;
                post = '<img src="/img/' + item.category + '.png" class="mr-3" width="64" height="64"><div class="media-body"><a href="news/' + item.id + '"><h5 class="mt-0">'+ item.title +'</h5></a>' + post + '</div>';
                post = '<div class = "row" style="padding: 22px 0 19px;"><div class="col"><div class="media">' + post +'</div></div></div>';

                dataHtml += post;
            });
            document.getElementById('news').innerHTML = dataHtml;
        }
    })

</script>

@endsection
