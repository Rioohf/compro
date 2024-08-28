@extends('layouts_2.app')
@section('content')
<div class="card">
    <div class="card-header bg-secondary text-white">Experience</div>
    <div class="card-body">
        <a href="{{route('experience.create')}}" class="btn btn-outline-primary btn-sm mb-2">ADD</a>
        <a href="{{route('experience.recycle')}}" class="btn btn-outline-warning btn-sm mb-2 position-relative">
            Recycle
            <span class="badge badge-pill badge-warning position-absolute top-0 start-100 translate-middle">
              {{$hitung}} <!-- assume $recycleCount is the variable holding the notification count -->
            </span>
          </a>
        <div class="table table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Position</th>
                        <th>Description</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experience as $index => $item )
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->position}}</td>
                        <td>{{$item->description}}</td>
                        <td class="justify-content-center"><a href="{{route('experience.edit', $item->id)}}" class="btn btn-success btn-sm m-2">Edit</a>
                        <form style="display: inline;" action="{{route('experience.softdelete', $item->id )}}" onsubmit="return confirm('Akan di delete sementara?')" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">SoftDelete</button>
                        </form></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection
@section('script-sweetalert')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const statusRadios = document.querySelectorAll('.status-radio');
        statusRadios.forEach(radio => {
            radio.addEventListener('click', (event) => {
                const itemId = event.target.getAttribute('data-id');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/admin/profiles/update-status/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success){
                    Swal.fire(
                        'Berhasil',
                        'Status berhasil diperbarui.',
                        'success'
                    );
                    statusRadios.forEach(r => {
                        if(r.getAttribute('data-id') != itemId){
                            r.checked = false;
                        }
                    });
                }else{
                    Swal.fire(
                        'Gagal',
                        data.error || 'Terjadi kesalahan saat memperbarui status',
                        'error'
                    );
                }
                })
                .catch(error => {
                    Swal.fire(
                        'Gagal',
                        'Terjadi kesalahan saat memperbarui status.',
                        'error'
                    );
                });
            });
        });
    });

</script>
@endsection
