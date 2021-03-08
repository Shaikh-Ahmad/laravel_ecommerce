@extends('layouts.app')
@section('content')
{{-- @if($errors->any())
<div class="error">{!! implode('', $errors->all('<div>:message</div>')) !!} </div>
@endif --}}
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
        <div class="card col-md-5 offset-md-3 my-4" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
            <div class="card-header">
                Create Product
            </div>
            <div class="card-body" style="margin: 20px">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" style="border-radius: 25px" name="title" id="title" class="form-control" value="{{old('title')}}" placeholder="title" >
                    @error('title')
                        <div class="error"><p class="text-danger float-right" style="font-size: 12px">{{ $message }}</p></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    {{-- <input type="text" style="border-radius: 25px" name="description" class="form-control" value="{{old('description')}}" placeholder="description" > --}}
                    <textarea class="form-control"  name="description" id="" cols="30" rows="5" placeholder="description" style="border-radius: 25px">{{old('description')}}</textarea>
                    @error('description')
                        <div class="error"><p class="text-danger float-right" style="font-size: 12px">{{ $message }}</p></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">price</label>
                    <input type="number" style="border-radius: 25px" name="price" class="form-control" value="{{old('price')}}" placeholder="price" >
                    @error('price')
                        <div class="error"><p class="text-danger float-right" style="font-size: 12px">{{ $message }}</p></div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_image">Product Image</label>
                    <input type="file" name="product_image" class="form-control" value="{{old('product_image')}}" >
                </div>
                <div class="form-group float-right ml-4" >
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
            </div>
            	   
        </div>
    </div>
</form>
@endsection

