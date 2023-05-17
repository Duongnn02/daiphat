@extends('main')
@section('content')
<div class="card">
    <h5 class="card-header">Người dùng</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Số điện thoại</th>
            <th>CMND/CCCD</th>
            <th>Email</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if ($users)

            @foreach ($users as $user)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->cccd_cmnd}}</td>
            <td>{{$user->email}}</td>
            <td class="d-flex">
                <a class="" href="javascript:void(0);"><i class="bx bx-edit-alt"></i> </a>
                <a class="" href="javascript:void(0);"><i class="bx bx-trash"></i> </a>
            </td>
        </tr>
        @endforeach
        @endif

        </tbody>
      </table>
    </div>
  </div>
  @endsection
