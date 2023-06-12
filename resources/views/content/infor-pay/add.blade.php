@extends('main')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Cập Nhật thông tin</h4>
    <div class="container-fluid">
        <div class="page-section">
            <form method="post" action="{{ route('infor-pay.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <legend>Thông tin thanh toán</legend>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên ngân hàng</label>
                                    <input name="bank" type="text"
                                        value="{{ old('bank') }}" id="example-text-input"
                                        class="form-control @error('bank') is-invalid @enderror">
                                    @error('bank')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tài khoản</label>
                                    <input name="bank_number" type="text"
                                        value="{{ old('bank_number') }}" id="example-text-input"
                                        class="form-control @error('bank_number') is-invalid @enderror">
                                    @error('bank_number')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chủ tài khoản</label>
                                    <input name="account_bank" type="text"
                                        value="{{ old('account_bank') }}" id="example-text-input"
                                        class="form-control @error('account_bank') is-invalid @enderror">
                                    @error('account_bank')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung chuyển khoản</label>
                                    <input name="content" type="text"
                                        value="{{ old('content') }}" id="example-text-input"
                                        class="form-control @error('content') is-invalid @enderror">
                                    @error('content')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thông báo</label>
                                    <input name="notification" type="text"
                                        value="{{ old('notification') }}" id="example-text-input"
                                        class="form-control @error('notification') is-invalid @enderror">
                                    @error('notification')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
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
