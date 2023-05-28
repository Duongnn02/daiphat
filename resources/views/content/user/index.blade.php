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
          <tr class="item-{{$user->id}}">
            <td>{{$loop->iteration}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->cccd_cmnd}}</td>
            <td>{{$user->email}}</td>
            <td class="d-flex">
                <a class="" href="{{route('user.edit', $user->id)}}"><i class="bx bx-edit-alt"></i> </a>
                <a data-href="{{ route('user.destroy', $user->id) }}" id="{{ $user->id }}"
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
    @isset($user)
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
                              $('.item-'+id).remove();
                          }
                      });
                  }
              })
          });
      </script>
  @endisset
  @endsection
