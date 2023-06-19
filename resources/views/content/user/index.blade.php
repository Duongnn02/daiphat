@extends('main')
@section('content')
<div class="card">
     <div class="loan-index d-flex row">
            <div class="title-loan col-md-3">
                <h5 class="card-header">Người dùng</h5>
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
            @if ($user->role_id != 1)
            <td class="d-flex">
                <a class="" href="{{route('user.edit', $user->id)}}"><i class="bx bx-edit-alt"></i> </a>
                <a class="" href="{{route('user.show', $user->id)}}"><i class="bi bi-eye"></i> </a>
                <a data-href="{{ route('user.destroy', $user->id) }}" id="{{ $user->id }}"
                    class="sm deleteIcon"><i class="bx bx-trash"></i>
                </a>
                <a class="" href="{{ route('user.forget-password', $user->id) }}"><i class="bi bi-lock h4 success"></i></a>
            </td>
            @endif
        </tr>
        @endforeach
        @endif

        </tbody>
        <div class="row">
            <div class="col-md-5 offset-md-7">
                <div class="btn-group float-end">
                    {{ $users->appends(request()->key_word)->links() }} </div>
            </div>
        </div>
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
