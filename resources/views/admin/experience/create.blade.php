@extends('layouts_2.app')
@section('content')
<form action="{{route('experience.store')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <label for="title">Profile</label>
    <select name="profile_id" id="" class="form-control">
        <option value="">Pilih Profile</option>
        @foreach($profiles as $profile)
        <option value="{{$profile->id}}">{{$profile->nama_lengkap}}</option>
        @endforeach
    </select>

</div>
<div class="mb-3">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control">
</div>
<div class="mb-3">
    <label for="position">Position</label>
    <input type="text" name="position" id="position" class="form-control">
</div>
<div class="mb-3">
    <label for="description">Descriptions</label>
    <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
</div>
<div class="mb-3">
    <button type="submit" class="btn btn-outline-primary">ADD</button>
    <a href="{{url('admin.experience')}}" class="btn btn-outline-danger">Back</a>
</div>
</form>
@endsection
