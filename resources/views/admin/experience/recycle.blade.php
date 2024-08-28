@extends('layouts_2.app')
@section('content')
<div class="card">
    <div class="card-header bg-secondary text-white">Experience</div>
    <div class="card-body">
        {{-- <a href="{{url('admin/profiles')}}" class="btn btn-secondary btn-sm mb-2">Back</a> --}}
        <div class="table table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Actions</th>
                        <th>Title</th>
                        <th>Position</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experience as $index => $item )
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td class="justify-content-center"><a href="{{route('experience.restore', $item->id)}}" class="btn btn-success btn-sm m-2">Restore</a>
                        <form style="display: inline;" action="{{route('experience.destroy', $item->id )}}" onsubmit="return confirm('Akan di delete permanen?')" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->position}}</td>
                        <td>{{$item->description}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer">
        <a href="{{url('experience')}}" class="btn btn-secondary btn-sm mb-2">Back</a>
    </div>
</div>
@endsection
