@extends('main')
@section('content')
<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                 alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                 style="width: 150px; z-index: 1">
                            <a href="{{route('user.edit', $user->id)}}" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                    style="z-index: 1;">
                                Edit profile
                            </a>
                        </div>
                        <div class="ms-3" style="margin-top: 130px;">
                            <h5>{{$user->name}}</h5>
                            <p>{{$user->phone}}</p>
                        </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                        <div class="d-flex justify-content-end text-center py-1">

                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="row">
                            <p class="lead fw-normal mb-1">Thông tin cá nhân</p>
                            <div class="p-4 col-md-5" style="background-color: #f8f9fa;">
                                <p class="font-italic mb-0">Số điện thoại: {{$user->phone}}</p>
                                <p class="font-italic mb-0">Ngày sinh: {{$user->day_of_birthday}}</p>
                                <p class="font-italic mb-1">Số CMND/CCCD: {{$user->cccd_cmnd}}</p>
                                <p class="font-italic mb-1">Nghề nghiệp: {{$user->academic_level}}</p>
                                <p class="font-italic mb-0">Email: {{$user->email}}</p>
                                <p class="font-italic mb-0">Lương: {{$user->salary}}</p>
                                <p class="font-italic mb-0">Mục đích vay vốn: {{$user->loan_purpose}}</p>
                            </div>
                            <div class="p-4 col-md-5" style="background-color: #f8f9fa;">
                                <p class="font-italic mb-1">Số Tk: {{$user->number_bank}}</p>
                                <p class="font-italic mb-1">Tên tài khoản: {{$user->account_name}}</p>
                                <p class="font-italic mb-0">Ngân hàng: {{$user->bank}}</p>
                                <p class="font-italic mb-0">Phương tiện: {{$user->vehicle}}</p>
                                <p class="font-italic mb-0">Địa chỉ: {{$user->address}}</p>
                                <p class="font-italic mb-0">Địa chỉ thường trú: {{$user->permanent_address}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <p class="lead fw-normal mb-1">Thông tin người thân</p>
                            <div class="p-4 col-md-5" style="background-color: #f8f9fa;">
                                <p class="font-italic mb-0">Mối quan hệ: {{$user->relationship_family}}</p>
                                <p class="font-italic mb-1">Họ và tên: {{$user->full_name_family}}</p>
                                <p class="font-italic mb-1">Số điện thoại: {{$user->phone_family}}</p>
                            </div>
                            <div class="p-4 col-md-5" style="background-color: #f8f9fa;">
                                <p class="font-italic mb-1">Mối quan hệ: {{$user->relationship_other}}</p>
                                <p class="font-italic mb-1">Họ và tên: {{$user->full_name_other}}</p>
                                <p class="font-italic mb-0">Số điện thoại: {{$user->phone_other}}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0">Ảnh thông tin</p>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-2">
                                <img src="{{asset($user->before_cccd_cmnd)}}"
                                     alt="image 1" class="w-100 rounded-3">
                            </div>
                            <div class="col mb-2">
                                <img src="{{asset($user->after_cccd_cmnd)}}"
                                     alt="image 1" class="w-100 rounded-3">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <img src="{{asset($user->face_cccd_cmnd)}}"
                                     alt="image 1" class="w-100 rounded-3">
                            </div>
                            <div class="col">
                                <img src="{{asset($user->additional_information)}}"
                                     alt="image 1" class="w-100 rounded-3">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <img src="{{asset($user->signature)}}"
                                     alt="image 1" class="w-100 rounded-3">
                            </div>
                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  @endsection
