@extends('layouts_2.app')
@section('content')
<form action="{{route('profiles.store')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <label for="picture">Photo</label>
    <input type="file" name="picture" id="picture" class="form-control">
</div>
<div class="mb-3">
    <label for="nama_lengkap">Nama</label>
    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
</div>
<div class="mb-3">
    <label for="no_telpon">No Telp</label>
    <input type="number" name="no_telpon" id="no_telpon" class="form-control">
</div>
<div class="mb-3">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control">
</div>
<div class="mb-3">
    <label for="descriptions">Descriptions</label>
    <textarea name="descriptions" id="descriptions" class="form-control" cols="30" rows="10"></textarea>
</div>
<div class="mb-3">
    <label for="facebook">Facebook</label>
    <input type="url" name="facebook" id="facebook" class="form-control" placeholder="https://example.com">
</div>
<div class="mb-3">
    <label for="x">X</label>
    <input type="url" name="x" id="x" class="form-control" placeholder="https://example.com">
</div>
<div class="mb-3">
    <label for="instagram">Instagram</label>
    <input type="url" name="instagram" id="instagram" class="form-control" placeholder="https://example.com">
</div>
<div class="mb-3">
    <label for="linkedin">LinkedIn</label>
    <input type="url" name="linkedin" id="linkedin" class="form-control" placeholder="https://example.com">
</div>
<div class="mb-3">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
</div>
<div class="mb-3">
    <button type="submit" class="btn btn-outline-primary">ADD</button>
    <a href="{{url('admin/profiles')}}" class="btn btn-outline-danger">Back</a>
</div>
</form>
@endsection
