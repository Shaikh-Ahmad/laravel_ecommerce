@extends('layouts.app')
@section('content')


    <div class="d-flex flex-row  m-4 " style="border:1px solid green; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

        <div class="container col-lg-4 shadow-lg rounded my-4" >
            <div class="p-2">
                <img src="{{asset('storage/product_images/'.$product->product_image)}}" alt="" height="260" width="260" class="img d-block mx-auto mb-3">
            </div>
        </div>

        <div class="pb-4"> 
            <hr style="border: 1px dashed green; height:100% ;width:0px ;"> 
        </div>
       
        
        <div class="container col-lg-4 shadow-lg rounded my-4  text-center"  >
            <div class="p-4">
            <h5> {{$product->title}}</h5>
            <h6 style="color: rgb(139, 138, 137)">{{ number_format($product->price, 2) }}<span style="font-size:10px"> /RS</span></h6>
                <p class="small text-muted font-italic">{{$product->description}}</p>
                <ul class="list-inline small">
                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                    <li class="list-inline-item m-0"><i class="fa fa-star-o text-success"></i></li>
                </ul>

                <div class="justify-content-center p-3">
                    <form action="{{route('cart.store')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="title" value="{{$product->title}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <button type="submit" class="btn btn-md btn-dark">Add to Cart</button>
                    </form>
                </div>

                <div class="justify-content-center ">
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="order-2 btn btn-sm btn-outline-danger " type="submit" title="delete" >
                           Delete
                        </button>
                        <a href="{{ route('products.edit', $product->id)}}" class="order-1 ml-2 btn btn-sm  btn-outline-primary  " >
                            Edit
                        </a>
                    </form>
                </div>

            </div>
        </div>

    </div>

    <br>
    <h5 class="title text-secondary pl-5 pt-3">Similar Product You may like...</h5>
    <div class="row p-5 text-center">
        @if ($products->count() > 0)
            @foreach ($products->sortByDesc('created_at') as $product)
                @include('product.products_card')
            @endforeach
        @else
            <p>No product</p>
        @endif
    </div>
    
<style>
    .vl {
      border-left: 1px solid green;
      height: 100%;
    }
    </style>

@endsection