
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#">E-commerce</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('products.create')}}">Create</a>
      </li>
      <li class="nav-item" style="width: 80px">
        <a class="nav-link " href="{{ route('cart.index')}}">Cart 
            @if (Cart::instance('default')->count() > 0)
              <div style="width:20px ; height:20px ; display:inline-block ; border-radius:50%" class="bg-warning ">
                <span style="padding-left:6px; font-size:12px ;color:black"><b>{{Cart::instance('default')->count()}}</b></span>
              </div>
            @endif
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> --}}
    </ul>
    <form action="{{ route('products.index')}}", method="GET" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2"  name="q" placeholder="Search  Product" >
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>