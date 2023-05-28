@extends('main')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Cập Nhật thông tin</h4>
    <div class="container-fluid">
        <div class="page-section">
            <form method="post" action="{{ route('loan.update', $loan->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-body">
                        <legend>Thông tin Khoản vay</legend>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tổng số tiền vay</label>
                                    <input name="total_loan" type="number"
                                        value="{{ $loan->total_loan ?? old('total_loan') }}" id="example-text-input"
                                        class="form-control @error('total_loan') is-invalid @enderror">
                                    @error('total_loan')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thời gian</label>
                                    <select name="time" id=""  class="form-control">
                                        <option @if ($loan->time == 6) selected @endif value="6">6 Tháng</option>
                                        <option @if ($loan->time == 12) selected @endif value="12">12 Tháng</option>
                                        <option @if ($loan->time == 18) selected @endif value="18">18 Tháng</option>
                                        <option @if ($loan->time == 24) selected @endif value="24">24 Tháng</option>
                                        <option @if ($loan->time == 36) selected @endif value="36">36 Tháng</option>
                                        <option @if ($loan->time == 48) selected @endif value="48">48 Tháng</option>
                                        <option @if ($loan->time == 60) selected @endif value="60">60 Tháng</option>
                                    </select>
                                    @error('time')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trạng thái</label>
                                    <select name="status" id="" class="form-control">
                                        <option @if ($loan->status == 1) selected @endif value="1">Từ chối</option>
                                        <option @if ($loan->status == 2) selected @endif value="2">Duyệt</option>
                                    </select>
                                    @error('status')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Trả nợ định kỳ</label>
                                    <input name="recurring_payment" type="text"
                                        value="{{ $loan->recurring_payment ?? old('recurring_payment') }}"
                                        id="example-text-input"
                                        class="form-control @error('recurring_payment') is-invalid @enderror">
                                    @error('recurring_payment')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-body form-group">
                                <div class="form-actions">
                                    <a class="btn btn-secondary float-right" href="{{ route('loan.index') }}">Close</a>
                                    <input type="submit" class="btn btn-info waves-effect waves-light add_product"
                                        value="Cập nhật">

                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    @endsection
