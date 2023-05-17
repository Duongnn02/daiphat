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
            <th>Tổng số tiền vay</th>
            <th>Thời gian</th>
            <th>Trạng thái</th>
            <th>Trả nợ định kỳ</th>
            <th>Ngày vay</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @if ($loans)

            @foreach ($loans as $loan)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$loan->user->name}}</td>
            <td>{{number_format($loan->total_loan) }}</td>
            <td>{{$loan->time}}</td>
            <td>
                @if ($loan->status == 0)
                <span class="badge bg-label-warning me-1">Chờ duyệt</span>
                @elseif ($loan->status == 1)
                <span class="badge bg-label-danger me-1">Từ chối</span>
                @elseif ($loan->status == 2)
                <span class="badge bg-label-success me-1">Đã duyệt</span>
                @endif
            <td>{{$loan->recurring_payment}}</td>
            <td class="d-flex">
                <a class="" href="{{route('loan.approval', $loan->id)}}"><i class="bi bi-check-circle-fill" style="color: darkcyan;"></i> </a>
                <a class="" href="{{route('loan.reject', $loan->id)}}"><i class="bi bi-x-circle-fill" style="color: crimson;margin-left: 4px;"></i></a>
                <a class="" href="javascript:void(0);"><i class="bx bx-edit-alt" style="color: blue;margin-left: 4px;"></i> </a>
                <a class="" href="javascript:void(0);"><i class="bx bx-trash" style="color: coral;margin-left: 4px;"></i> </a>
            </td>
            <td>{{$loan->created_at}}</td>
        </tr>
        @endforeach
        @endif

        </tbody>
      </table>
    </div>
  </div>
  @endsection
