@extends('layouts.app')
@section('content')

<div class="row">

  <div class="col col-md-6 ">
      <div class="row justify-content-center ml-4">
          <form action="{{ route('shop.stripePayment') }}" method="post" id="payment-form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h5 class="text-left mb-4">Billing Detail</h5>
            <div class="form-group row">
                <label for="email" class="col-sm-3">Email</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="email" id="" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3">Name</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="adress" class="col-sm-3">Adress</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" name="address" id="address" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" value="">
                </div>
                <div class="form-group col-md-6">
                    <label for="province" >Province</label>
                    <input type="text" class="form-control" name="province" id="province" value="">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="postal_code">Postal Code</label>
                    <input type="number" class="form-control" name="postalcode" id="postalcode" value="">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_no" >Phone</label>
                    <input type="number" class="form-control" name="phone_no" id="phone_no" value="">
                </div>
            </div>
            <h5 class="text-left mb-4">Payment Detail</h5>
            <div class="form-group">
                <label for="name_on_card" >Name on card</label>
                <input type="text" class="form-control" name="name_on_card" id="name_on_card" value="">
            </div>
            <div class="form-group">
                <label  for="card-element">
                    Credit or debit card
                </label>
                <div id="card-element" class="form-control">
                    <!-- a Stripe Element will be inserted here. -->
                </div>
            
                <!-- Used to display form errors -->
                <div id="card-errors" role="alert" style="color: rgb(236, 91, 91) "></div>
            </div>
            <button type="submit" id="complete-order" class="btn btn-dark btn-lg  w-100 text-center">Submit payment</button>
          </form>
      </div>
  </div>

  <div class="col col-md-4 mr-1 ">
      <h5 class="text-center ">Your Order</h5>
      @if (Cart::count() > 0)   
      <h6 class="title">Total items: {{Cart::content()->count()}}</h6>
      @foreach (Cart::content() as $item)
          <hr>
          <div class="row">
              <div class="col col-md-2 ">
                  <img src="{{asset('storage/product_images/'.$item->model->product_image)}}" alt="" width="40" height="40">
              </div>
              <div class="col col-md-2 ">
                  <h6>{{$item->name}}</h6>
              </div>
              <div class="col col-md-2 offset-md-2">
                  <p style="border:1px solid black" class="text-center">{{$item->qty}}</p>
              </div>
              <div class="col col-md-4">
                  Price: {{$item->price}}<span style="font-size: 12px">/rs</span>
              </div>
          </div> 
      @endforeach
      <table class="table mt-4 border bg-light" >
          <tbody>
              <tr>
                  <td >Sub Total</td>
                  <td colspan="2">&nbsp;</td>
                  <td><?php echo Cart::subtotal(); ?><span style="font-size: 12px">/rs</span></td>
              </tr>
              <tr>
                  <td >Tax(2%)</td>
                  <td colspan="2"></td>
                  <td><?php echo Cart::tax(); ?><span style="font-size: 12px">/rs</span></td>
              </tr>
              <tr>
                  <th>Total</th>
                  <td colspan="2"></td>
                  <td><strong><?php echo Cart::total(); ?></strong><span style="font-size: 12px">/rs</span></td>
              </tr>
        
          </tbody>
      </table>   
      @else
          <div>
              <h5 class="title text-secondary">No Items in cart</h5>
              <a href="{{route('shop')}}" class="btn btn-light">Continue Shoping..</a>
          </div>
      @endif

  </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  
  
                                        // CARD UI
      var stripe = Stripe('pk_test_51IOOuQKD8xrNAjBlDAizcEeXIl88sUCUpUdNSHhNvb1jP66pG4jHIC2DpLwcXMEawNUzvSenxPoiwJta91NvLeWQ00abnh2fNI');
      var elements = stripe.elements();
  
      var card = elements.create('card', {hidePostalCode : true});
  
      // Add an instance of the card UI component into the `card-element` <div>
      card.mount('#card-element');
  
                                        //Securly Collect card Detail   
  
      function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
      // Submit the form
      form.submit();
      }
      console.log(document.getElementById('city').value);

        // //   self-code collecting neccesary data
        var options = {
                name: document.getElementById("name_on_card").value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
            }

        

            // $(document).on('click', '.c', function() {
            //     alert(document.getElementById('name_on_card').value);
            //     console.log(document.getElementById('name_on_card').value)
            // });
  
      function createToken() {
      stripe.createToken(card, options).then(function(result) {
          if (result.error) {
          // Inform the user if there was an error
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
          } else {
          // Send the token to your server
          stripeTokenHandler(result.token);
          }
      });
  
      };
      // Create a token when the form is submitted.
      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(e) {
      e.preventDefault();
      createToken();
      });
  
                                      // Handel Event and Error
  
      card.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
          displayError.textContent = event.error.message;
      } else {
          displayError.textContent = '';
      }
      });


</script>

<style>

.result-message {
 line-height: 22px;
 font-size: 16px;
}
.result-message a {
 color: rgb(89, 111, 214);
 font-weight: 600;
 text-decoration: none;
}
.hidden {
 display: none;
}
#card-error {
 color: rgb(250, 0, 0);
 text-align: left;
 font-size: 13px;
 line-height: 17px;
 margin-top: 12px;
}
#card-element {
 border-radius: 4px 4px 0 0 ;
 height: 50px;
 background: white;
}


/* spinner/processing state, errors */
.spinner,
.spinner:before,
.spinner:after {
 border-radius: 50%;
}
.spinner {
 color: #ffffff;
 font-size: 22px;
 text-indent: -99999px;
 margin: 0px auto;
 position: relative;
 width: 20px;
 height: 20px;
 box-shadow: inset 0 0 0 2px;
 -webkit-transform: translateZ(0);
 -ms-transform: translateZ(0);
 transform: translateZ(0);
}
.spinner:before,
.spinner:after {
 position: absolute;
 content: "";
}
.spinner:before {
 width: 10.4px;
 height: 20.4px;
 background: #5469d4;
 border-radius: 20.4px 0 0 20.4px;
 top: -0.2px;
 left: -0.2px;
 -webkit-transform-origin: 10.4px 10.2px;
 transform-origin: 10.4px 10.2px;
 -webkit-animation: loading 2s infinite ease 1.5s;
 animation: loading 2s infinite ease 1.5s;
}
.spinner:after {
 width: 10.4px;
 height: 10.2px;
 background: #5469d4;
 border-radius: 0 10.2px 10.2px 0;
 top: -0.1px;
 left: 10.2px;
 -webkit-transform-origin: 0px 10.2px;
 transform-origin: 0px 10.2px;
 -webkit-animation: loading 2s infinite ease;
 animation: loading 2s infinite ease;
}
@-webkit-keyframes loading {
 0% {
   -webkit-transform: rotate(0deg);
   transform: rotate(0deg);
 }
 100% {
   -webkit-transform: rotate(360deg);
   transform: rotate(360deg);
 }
}
@keyframes loading {
 0% {
   -webkit-transform: rotate(0deg);
   transform: rotate(0deg);
 }
 100% {
   -webkit-transform: rotate(360deg);
   transform: rotate(360deg);
 }
}
@media only screen and (max-width: 600px) {
 form {
   width: 80vw;
 }
}
   </style>

@endsection



















