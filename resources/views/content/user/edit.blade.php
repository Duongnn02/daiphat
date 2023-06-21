@extends('main')
@section('content')
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Cập Nhật thông tin</h4>
                <div class="container-fluid">
                    <div class="page-section">
                        <form method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <legend>Thông tin cá nhân</legend>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Họ và tên</label>
                                                <input name="name" type="text" value="{{ $user->name ?? old('name') }}"
                                                id="example-text-input"
                                                class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số điện thoại</label>
                                                <input name="phone" type="number" value="{{ $user->phone ?? old('phone') }}"
                                                id="example-text-input"
                                                class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                                <div class="text text-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">E-mail</label>
                                                <input name="email" type="email" value="{{ $user->email ?? old('email') }}" id="example-text-input"
                                                    class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Trình độ học vấn</label>
                                                <input name="academic_level" type="text" value="{{ $user->academic_level ?? old('academic_level') }}"
                                                    id="example-text-input"
                                                    class="form-control @error('academic_level') is-invalid @enderror">
                                                @error('academic_level')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Lương</label>
                                                <input name="salary" type="number" value="{{ $user->salary ?? old('salary') }}"
                                                    id="example-text-input"
                                                    class="form-control @error('salary') is-invalid @enderror">
                                                @error('salary')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Địa chỉ</label>
                                                <input name="address" type="text" value="{{ $user->address ?? old('address') }}"
                                                    id="example-text-input" class="form-control @error('address') is-invalid @enderror">
                                                @error('address')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nhà</label>
                                                <input name="address" type="text" value="{{ $user->address ?? old('address') }}"
                                                    id="example-text-input" class="form-control @error('house') is-invalid @enderror">
                                                @error('house')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phương tiện</label>
                                                <input name="vehicle" type="text" value="{{ $user->vehicle ?? old('vehicle') }}"
                                                    id="example-text-input" class="form-control @error('vehicle') is-invalid @enderror">
                                                @error('vehicle')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tên tài khoản</label>
                                                <input name="account_name" type="text" value="{{ $user->account_name ?? old('account_name') }}"
                                                    id="example-text-input" class="form-control @error('account_name') is-invalid @enderror">
                                                @error('account_name')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ngân hàng</label>
                                                <input name="bank" type="text" value="{{ $user->bank ?? old('bank') }}"
                                                    id="example-text-input" class="form-control @error('bank') is-invalid @enderror">
                                                @error('bank')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số tài khoản</label>
                                                <input name="number_bank" type="text" value="{{ $user->number_bank ?? old('number_bank') }}"
                                                    id="example-text-input" class="form-control @error('number_bank') is-invalid @enderror">
                                                @error('number_bank')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mục đích vay vốn</label>
                                                <input name="loan_purpose" type="text" value="{{ $user->loan_purpose ?? old('loan_purpose') }}"
                                                    id="example-text-input" class="form-control @error('loan_purpose') is-invalid @enderror">
                                                @error('loan_purpose')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <legend>Thông tin liên hệ của gia đình</legend>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mối quan hệ</label>
                                                <select class="form-select" aria-label="Default select example" name="relationship_family">
                                                   @foreach($relationships as $key => $relationship)
                                                        <option value="{{$key}}" {{$key == $user->relationship_family ? 'selected' : '' }}>{{$relationship}}</option>
                                                    @endforeach
                                                </select>
                                                @error('relationship_family')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Họ và tên</label>
                                                <input name="full_name_family" type="text" value="{{ $user->full_name_family ?? old('full_name_family') }}"
                                                       id="example-text-input"
                                                       class="form-control @error('full_name_family') is-invalid @enderror">
                                                @error('full_name_family')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số điện thoại</label>
                                                <input name="phone_family" type="number" value="{{ $user->phone_family ?? old('phone_family') }}" id="example-text-input"
                                                       class="form-control @error('phone_family') is-invalid @enderror">
                                                @error('phone_family')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-body border-top">
                                    <legend>Thông tin liên hệ khác</legend>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mối quan hệ</label>
                                                <select class="form-select" aria-label="Default select example" name="relationship_other">
                                                    @foreach($relationships as $key => $relationship)
                                                    <option value="{{$key}}" {{$key == $user->relationship_other ? 'selected' : '' }}>{{$relationship}}</option>
                                                    @endforeach
                                                </select>
                                                @error('relationship_other')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Họ và tên</label>
                                                <input name="full_name_other" type="text" value="{{ $user->full_name_other ?? old('full_name_other') }}"
                                                       id="example-text-input"
                                                       class="form-control @error('full_name_other') is-invalid @enderror">
                                                @error('full_name_other')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số điện thoại</label>
                                                <input name="phone_other" type="number" value="{{ $user->phone_other ?? old('phone_other') }}" id="example-text-input"
                                                       class="form-control @error('phone_other') is-invalid @enderror">
                                                @error('phone_other')
                                                <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-body border-top">
                                    <legend>Thông tin CMND/CCCD</legend>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="cccd_cmnd">Số CMND</label>
                                                <input name="cccd_cmnd" type="text" id="cccd_cmnd"
                                                    value="{{ $user->cccd_cmnd ?? old('cccd_cmnd') }}"
                                                    class="form-control @error('cccd_cmnd') is-invalid @enderror">
                                                @error('cccd_cmnd')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="image">Ảnh mặt trước</label><br>
                                                <div class="card_file_name">
                                                    <div class="form-group form_img  @error('before_cccd_cmnd') border border-danger @enderror">
                                                        <input type="file" name="before_cccd_cmnd" id="file"
                                                            class="form-control file before_cccd_cmnd">
                                                    </div>
                                                    <div class="card-img">
                                                        <img id="before_cccd_cmnd" class="rounded image_show w-100" src="{{asset($user->before_cccd_cmnd)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="image">Ảnh mặt sau</label><br>
                                                <div class="card_file_name">
                                                    <div class="form-group form_img  @error('after_cccd_cmnd') border border-danger @enderror">
                                                        <input type="file" name="after_cccd_cmnd" id="file"
                                                            class="form-control after_cccd_cmnd ">
                                                    </div>
                                                    <div class="card-img">
                                                        <img id="after_cccd_cmnd" class="rounded image_show w-100" src="{{asset($user->after_cccd_cmnd)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="image">Ảnh chụp mặt và cầm CCCD/CMND</label><br>
                                                <div class="card_file_name">
                                                    <div class="form-group form_img  @error('face_cccd_cmnd') border border-danger @enderror">
                                                        <input type="file" name="face_cccd_cmnd" id="file"
                                                            class="form-control face_cccd_cmnd ">
                                                    </div>
                                                    <div class="card-img">
                                                        <img id="face_cccd_cmnd" class="rounded image_show w-100" src="{{asset($user->face_cccd_cmnd)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="image">Thông tin bổ sung</label><br>
                                                <div class="card_file_name">
                                                    <div class="form-group form_img  @error('additional_information') border border-danger @enderror">
                                                        <input type="file" name="additional_information" id="file"
                                                            class="form-control additional_information ">
                                                    </div>
                                                    <div class="card-img">
                                                        <img id="additional_information" class="rounded image_show w-100" src="{{asset($user->additional_information)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="image">Chữ ký</label><br>
                                                <div class="card_file_name">
                                                    <div class="form-group form_img  @error('signature') border border-danger @enderror">
                                                        <input type="file" name="signature" id="file"
                                                               class="form-control signature ">
                                                    </div>
                                                    <div class="card-img">
                                                        <img id="signature" class="rounded image_show w-100" src="{{asset($user->signature)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body form-group">
                                    <div class="form-actions">
                                        <a class="btn btn-secondary float-right" href="{{ route('user.index') }}">Close</a>
                                        <input type="submit" class="btn btn-info waves-effect waves-light add_product"
                                            value="Cập nhật">

                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.before_cccd_cmnd').change(function(e) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#before_cccd_cmnd').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(e.target.files['0']);
                        });
                        $('.after_cccd_cmnd').change(function(e) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#after_cccd_cmnd').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(e.target.files['0']);
                        });
                        $('.face_cccd_cmnd').change(function(e) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#face_cccd_cmnd').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(e.target.files['0']);
                        });
                        $('.additional_information').change(function(e) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#additional_information').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(e.target.files['0']);
                        });
                        $('.signature').change(function(e) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $('#signature').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(e.target.files['0']);
                        });
                    });
                </script>

@endsection
