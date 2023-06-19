@extends('main')
@section('content')
    <div class="card">
        <div class="loan-index d-flex row">
            <div class="title-loan col-md-3">
                <h5 class="card-header">Khoản vay</h5>
            </div>
            <div class="col-md-9">
                <form action="" class="row">
                    <div class="input-group input-group-merge col-md-4 search-loan">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" value="{{request()->key_word}}" name="key_word" placeholder="Tìm kiếm theo tên số điện thoại" aria-label="Search..."
                            aria-describedby="basic-addon-search31">
                    </div>
                    <div class="btn-search col-md-2">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
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
                        <th>Hành động</th>
                        <th>Rút tiền</th>
                        <th>Ngày vay</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($loans)
                        @foreach ($loans as $key => $loan)
                            <tr class="item-{{ $loan->id }}">
                                <td>{{ $loan->key + 1 }}</td>
                                <td>{{ $loan->user->name ?? '' }}</td>
                                <td>{{ number_format($loan->total_loan) }}</td>
                                <td>{{ $loan->time }}</td>
                                <td>
                                    @if ($loan->status == 0)
                                        <span class="badge bg-label-warning me-1">Chờ duyệt</span>
                                    @elseif ($loan->status == 1)
                                        <span class="badge bg-label-danger me-1">Từ chối</span>
                                    @elseif ($loan->status == 2)
                                        <span class="badge bg-label-success me-1">Đã duyệt</span>
                                    @endif
                                <td>{{ $loan->recurring_payment }}</td>
                                <td class="d-flex">
                                    <a class="" href="{{ route('loan.approval', $loan->id) }}"><i
                                            class="bi bi-check-circle-fill" style="color: darkcyan;"></i> </a>
                                    <a class="" href="{{ route('loan.reject', $loan->id) }}"><i
                                            class="bi bi-x-circle-fill" style="color: crimson;margin-left: 4px;"></i></a>
                                    <a class="" href="{{ route('loan.edit', $loan->id) }}"><i class="bx bx-edit-alt"
                                            style="color: blue;margin-left: 4px;"></i> </a>
                                    <a data-href="{{ route('loan.destroy', $loan->id) }}" id="{{ $loan->id }}"
                                        class="sm deleteIcon"><i class="bx bx-trash"></i></a>
                                </td>
                                <td>
                                @if($loan->type !== 0)
                                <a class="" href="{{ route('loan.approval-withdrawl', $loan->id) }}"><i
                                        class="bi bi-check-circle-fill" style="color: darkcyan;"></i> </a>
                                <a class="" href="{{ route('loan.reject-withdraw', $loan->id) }}"><i
                                        class="bi bi-x-circle-fill" style="color: crimson;margin-left: 4px;"></i></a>
                                @endif
                                </td>
                                <td>{{ $loan->created_at }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            <div class="row">
                <div class="col-md-5 offset-md-7">
                    <div class="btn-group float-end">
                        {{ $loans->appends(request()->key_word)->links() }} </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @isset($loan)
        <script>
            $(document).on('click', '.deleteIcon', function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let href = $(this).data('href');
                let csrf = '{{ csrf_token() }}';
                console.log(id);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    console.log(result);
                    if (result.isConfirmed) {
                        $.ajax({
                            url: href,
                            method: 'delete',
                            data: {
                                _token: csrf
                            },
                            success: function(res) {
                                console.log(res);

                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                $('.item-' + id).remove();
                            }
                        });
                    }
                })
            });
        </script>
    @endisset
@endsection
