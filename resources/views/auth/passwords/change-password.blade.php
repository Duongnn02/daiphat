@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Đổi mật khẩu</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.change-password') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu cũ</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value="{{old('old_password')}}" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="new-password">

                                @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu mới</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value="{{old('new_password')}}" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">

                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" value="{{old('confirm_password')}}" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">

                                @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
