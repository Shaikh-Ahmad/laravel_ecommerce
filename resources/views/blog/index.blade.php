
@extends('layouts.app')
@section('content')
    <div class="text-center">
    <h4>Blogs</h4>
    </div>
    <div class="container">
        @if ($blogs->count() > 0)
            @foreach ($blogs->sortByDesc('created_at') as $blog)
                <br>
                <div class="card col-md-5 offset-md-4" >
                    <a href="blogs/{{$blog->id}}">   
                        <div class="card-header " >
                        <h3>{{$blog->title}}</h3>
                        </div>
                    </a>
                    <div class="card-body" style="margin:25px">
                    <p>{{$blog->content}}</p>
                    </div>
                    <div class="card-footer">
                        {{$blog->created_at}}
                        <div style="display:inline-block; margin-left:200px"><a class="btn btn-sm bg-primary" href="blogs/{{$blog->id}}">show</a></div>
                    </div>
                </div>
            
                <br>
            @endforeach
        @else
            <p>No Blog</p>
        @endif
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $blogs->links() !!}
        </div>
    </div>
    

@endsection

