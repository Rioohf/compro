@extends('layouts_2.app')
@section('content')
<div class="card">
    <div class="card-header bg-secondary text-white">Edit Experience</div>
    <div class="card-body">
        <form action="{{route('experience.update', $experience->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$experience->title}}">
            </div>
            <div class="mb-3">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="{{$experience->position}}">
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$experience->description}}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-outline-primary">Update</button>
                <a href="{{url('experience')}}" class="btn btn-outline-danger">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
