@extends('layouts.app')
@section('content')
    <br>
    <div class="text-center">
        <h4>show Blog</h4>
        </div>
    <div class="card col-md-5 offset-md-4">
        <div class="card-header bg-primary" >
        <h3>{{$blog->title}}</h3>
        </div>
        <div class="card-body" style="margin:25px">
        <p>{{$blog->content}}</p>
        </div>
        <div class="card-footer ">
            <div class="col">{{$blog->created_at}}</div>
            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="col text-right">
                <button  type="submit" title="delete" style="border: none; background-color:transparent;">
                    <i class="fas fa-trash fa-lg text-danger "></i>
                </button>
                <a class="btn bg-primary" href="{{$blog->id}}/edit">Edit</a>
                </div>
            </form>
        </div>

    </div>

@endsection