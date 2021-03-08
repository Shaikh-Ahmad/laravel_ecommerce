
@extends('layouts.app')
@section('content')

  @include('layouts.header')

  <div class="text-center mt-4 lg:text-3xl">
      <h3 class="title text-secondary">Products</h3>
  </div>

  <div class="row p-5 text-center">
    
    <div class="col col-lg-3 col-md-4 col-sm-6 text-center mb-4">
      <h4 class="text-secondary ">catogories</h4>
      <div class="card" >
          <ul class="p-4">
              <a href=""><li>Smart phones</li></a>
              <a href=""><li>Electronics</li></a>
              <a href=""><li>Home Accesories</li></a>
              <a href=""><li>LED's</li></a>
              <a href=""><li>Clothings</li></a>
              <a href=""><li>Fasion</li></a>
              <a href=""><li>Stationary</li></a>
          </ul>
      </div>
    </div>

    @if ($products->count() > 0)
      @foreach ($products->sortByDesc('created_at') as $product)
        @include('product.products_card')
      @endforeach
    @else
      <p>No product</p>
    @endif
    
  </div>

  {{-- Pagination --}}
  <div class="d-flex justify-content-center m-4">
      {!! $products->links() !!}
  </div>
          
@endsection

