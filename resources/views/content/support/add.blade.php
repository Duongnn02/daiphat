@extends('main')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Thêm thông tin</h4>
    <div class="container-fluid">
        <div class="page-section">
            <form method="post" action="{{ route('app.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <legend>Thông tin Ứng dụng</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ứng dụng</label>
                                    <input name="app" type="text"
                                        value="{{ old('app') }}" id="example-text-input"
                                        class="form-control @error('app') is-invalid @enderror">
                                    @error('app')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đường dẫn</label>
                                    <input name="link" type="text"
                                        value="{{ old('link') }}" id="example-text-input"
                                        class="form-control @error('link') is-invalid @enderror">
                                    @error('link')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-body form-group">
                                <div class="form-actions">
                                    <a class="btn btn-secondary float-right" href="{{ route('app.index') }}">Close</a>
                                    <input type="submit" class="btn btn-info waves-effect waves-light add_product"
                                        value="Cập nhật">

                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    @endsection
