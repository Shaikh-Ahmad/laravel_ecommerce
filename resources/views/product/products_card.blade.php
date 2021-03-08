<div class="col col-lg-3 col-md-4 col-sm-6 mb-4 mb-2">
    <!-- Card-->
    <div class="card shadow-lg rounded  border-1" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="card-body p-2">
          <img src="{{asset('storage/product_images/'.$product->product_image)}}" alt="" height="160" width="160" class="img d-block mx-auto mb-3" alt="Product">
          <h5> <a href="{{ route('products.show', $product->id)}}" class="text-dark">{{$product->title}}</a></h5>
          <h6 style="color: rgb(139, 138, 137)">{{ number_format($product->price, 2) }}<span style="font-size:10px"> /RS</span></h6>
            {{-- <p class="small text-muted font-italic">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> --}}
            <ul class="list-inline small">
                <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                <li class="list-inline-item m-0"><i class="fa fa-star-o text-success"></i></li>
            </ul>
        </div>
    </div>
</div>