@extends('main')
@section('content')
    <div class="card">
        <div>
            <div class="logo d-flex">
                <div class="title">
                    <h5 class="card-header">Thông tin thanh toán</h5>
                </div>
                <div class="add-logo">
                    <a class="btn btn-success" href="{{ route('infor-pay.create') }}">Thêm Thông tin </a>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tên ngân hàng</th>
                        <th>Số tài khoản</th>
                        <th>Tên chủ sở hữa</th>
                        <th>Nội dung thanh toán</th>
                        <th>Thông báo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($inforPays)
                        @foreach ($inforPays as $inforPay)
                            <tr class="item-{{ $inforPay->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inforPay->bank }}</td>
                                <td>{{ $inforPay->bank_number }}</td>
                                <td>{{ $inforPay->account_bank }}</td>
                                <td>{{ $inforPay->content }}</td>
                                <td>{{ $inforPay->notification }}</td>
                               
                                <td class="d-flex">
                                    <a data-href="{{ route('infor-pay.destroy', $inforPay->id) }}" id="{{ $inforPay->id }}"
                                        class="sm deleteIcon"><i class="bx bx-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @isset($inforPay)
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
