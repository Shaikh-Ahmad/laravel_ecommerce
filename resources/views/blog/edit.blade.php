@extends('layouts.app')
@section('content')
<div class="text-center">
    <h4>Edit Blog</h4>
</div>
<form method="POST" action="{{ route('blogs.update',$blog->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <div class="card">
            <div class="card-header">
                Edit blog
            </div>
            <div class="card-body" style="margin: 50px">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input  style="border-radius: 25px" value="{{$blog->title}}" name="title" id="title" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input  style="border-radius: 25px" value="{{$blog->content}}" name="content" id="content" class="form-control" placeholder="content" >
                </div>
                <div class="form-group float-right ml-4" >
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
            </div>
            	   
        </div>
    </div>
</form>
@endsection

