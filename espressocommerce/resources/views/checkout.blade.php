@extends('layout.default')

@section('title','Ecommerce App-Home')
    
@section('content')

<main class="container" style="max-width: 900px">
<section>
    <h1>Checkout</h1>
    @if(session()->has('success'))
    <div>
    {{session()->get('success')}}
    </div>
  @endif
  
  @if(session()->has('error'))
  <div class="alert alert-danger">
  {{session()->get('error')}}
  </div>
  @endif
    <form action="{{route('product.postmethod.orders')}}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Address</label>
          <input type="text" class="form-control" id="address" aria-describedby="emailHelp" name="address">
        </div>
        <div class="mb-3">
          <label for="pincode" class="form-label">Pincode</label>
          <input type="text" class="form-control" id="pincode" name="pincode" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name="phone">
          </div>
        
        <button type="submit" class="btn btn-primary">Proceed to payment</button>
      </form>
</section>
</main>

@endsection