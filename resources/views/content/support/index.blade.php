@extends('main')
@section('content')
    <div class="card">
        <div>
            <div class="logo d-flex">
                <div class="title">
                    <h5 class="card-header">Ứng dụng hỗ trợ</h5>
                </div>
                <div class="add-logo">
                    <a class="btn btn-success" href="{{ route('app.create') }}">Thêm Ứng dụng</a>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Ứng dụng</th>
                        <th>Link</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                        @foreach ($apps as $app)
                            <tr class="item-{{ $app->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $app->app }}</td>
                                <td>{{ $app->link }}</td>
                                <td class="d-flex">
                                    <a class="" href="{{ route('app.change-status', $app->id) }}">
                                        @if ($app->status == 1)
                                            <i class="bi bi-check-circle-fill " style="color:darkcyan; font-size: 20px;">
                                            </i>
                                        @else
                                            <i class="bi bi-check-circle-fill" style="color:crimson; font-size: 20px;">
                                            </i>
                                        @endif
                                    </a>
                                    <a data-href="{{ route('app.destroy', $app->id) }}" id="{{ $app->id }}"
                                        class="sm deleteIcon"><i class="bx bx-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @isset($apps)
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
