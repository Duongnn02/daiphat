@extends('main')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Cập Nhật thông tin</h4>
    <div class="container-fluid">
        <div class="page-section">
            <form method="post" action="{{ route('logo.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <legend>Thông tin logo</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mô tả</label>
                                    <input name="description" type="text"
                                        value="{{ old('description') }}" id="example-text-input"
                                        class="form-control @error('description') is-invalid @enderror">
                                    @error('description')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="image">logo</label><br>
                                    <div class="card_file_name">
                                        <div class="form-group form_img  @error('logo') border border-danger @enderror">
                                            <input type="file" name="logo" id="file"
                                                class="form-control logo ">
                                        </div>
                                        <div class="card-img">
                                            <img id="logo" class="rounded image_show w-100" src="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body form-group">
                                <div class="form-actions">
                                    <a class="btn btn-secondary float-right" href="{{ route('logo.index') }}">Close</a>
                                    <input type="submit" class="btn btn-info waves-effect waves-light add_product"
                                        value="Cập nhật">

                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    @endsection
