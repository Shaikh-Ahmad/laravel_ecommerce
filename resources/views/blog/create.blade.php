@extends('layouts.app')
@section('content')
<div class="text-center">
    <h4>Create Blog</h4>
</div>
<form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        <div class="card" >
            <div class="card-header">
                Create blog
            </div>
            <div class="card-body" style="margin: 50px">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input  style="border-radius: 25px" name="title" id="title" class="form-control" placeholder="title" >
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input  style="border-radius: 25px" name="content" id="content" class="form-control" placeholder="content" >
                </div>
                <div class="form-group float-right ml-4" >
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
            </div>
            	   
        </div>
    </div>
</form>
@endsection

