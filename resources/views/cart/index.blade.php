@extends('layouts.app')
@section('content')

<div class="container mx-auto">
    @if (Cart::count() > 0)   
        <h4 class="title text-secondary">Items in cart {{Cart::content()->count()}}</h4>
        @foreach (Cart::content() as $item)
            <hr>
            <div class="row">
                <div class="col col-md-1">
                    <img src="{{asset('storage/product_images/'.$item->model->product_image)}}" alt="" width="70" height="70">
                </div>
                <div class="col col-md-6 pl-4">
                    <h6>{{$item->name}}</h6>
                    <p style="font-size: 12px">Description: {{$item->model->description}} {{$item->model->description}}</p>
                </div>
                <div class="col col-md-2 ">
                        <form action="{{route('cart.destroy' , $item->rowId)}}" method="POST" style="margin: 1px">
                        {{ csrf_field() }}
                        @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Remove</button>
                        </form>
                        <form action="{{route('cart.wishlist' , $item->rowId)}}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-sm btn-outline-info " type="submit">Add to Wishlist</button>
                        </form>
                </div>
                <div class="col col-md-1 mx-auto">
                    <select class="quantity">
                        <option value="" selected>{{$item->qty}}</option>
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                    </select>
                </div>
                <div class="col col-md-2">
                    Price: {{$item->price}}<span style="font-size: 12px">/rs</span>
                </div>
            </div>    
        @endforeach
    @else
        <div>
            <h5 class="title text-secondary">No Items in cart </h5>
            <a href="{{route('shop')}}" class="btn btn-light">Continue Shoping..</a>
        </div>
    @endif
</div>

<br>

<div class="row mx-auto col-md-6 p-4 bg-light ">
    <div class="col-md-7 p-2">
       Shipping cost is free because we are awsome and we take care of our costumers.
       Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius consequuntur quisquam quia modi voluptatum cumque provident officiis accusamus illum, officia ad in ea veritatis quas repellat facere ex maiores blanditiis.
    </div>
    <div class="col-md-5 p-2">
        <table class="table">
            <tbody>
                <tr>
                    <td scope="row">Sub Total</td>
                    <td colspan="2">&nbsp;</td>
                    <td><?php echo Cart::subtotal(); ?><span style="font-size: 12px">/rs</span></td>
                </tr>
                <tr>
                    <td scope="row">Tax(2%)</td>
                    <td colspan="2"></td>
                    <td><?php echo Cart::tax(); ?><span style="font-size: 12px">/rs</span></td>
                </tr>
                <tr>
                    <th scope="row">Total</th>
                    <td colspan="2"></td>
                    <td><strong><?php echo Cart::total(); ?></strong><span style="font-size: 12px">/rs</span></td>
                </tr>
          
            </tbody>
        </table>
    </div>
</div>

@if (Cart::count() > 0) 
    <div class="row justify-content-md-center mb-4 ">
        <a href="{{route('shop')}}" class="btn btn-light m-2">Continue Shoping..</a>
        <a href="{{route('shop.checkout')}}" class="btn btn-success m-2">Checkout</a>
    </div>
@endif


<div class="container mt-4">
@if (Cart::instance('wishlist')->count() > 0)
    <h5>Items in Wishlist</h5>
    @foreach (Cart::instance('wishlist')->content() as $item)
    <hr>
    <div class="row">
        <div class="col col-md-1">
            <img src="{{asset('storage/product_images/'.$item->model->product_image)}}" alt="" width="70" height="70">
        </div>
        <div class="col col-md-6 pl-4">
            <h6>{{$item->name}}</h6>
            <p style="font-size: 12px">Description: {{$item->model->description}} {{$item->model->description}}</p>
        </div>
        <div class="col col-md-2 ">
                <form action="{{route('cart.destroyWishlist' , $item->rowId)}}" method="POST" style="margin: 1px">
                {{ csrf_field() }}
                @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger " type="submit">Remove</button>
                </form>
                <form action="{{route('cart.switchToCartFromWishlist' , $item->rowId)}}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-sm btn-outline-info " type="submit">Move to Cart</button>
                </form>
        </div>
        <div class="col col-md-1 mx-auto">
            <select class="quantity">
                <option value="" selected>{{$item->qty}}</option>
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
            </select>
        </div>
        <div class="col col-md-2">
            Price: {{$item->price}}<span style="font-size: 12px">/rs</span>
        </div>
    </div>   
    @endforeach
@else
    <br>
    <h5 class="title text-secondary">You have no item in Wishlist</h5>
@endif

</div>

@endsection