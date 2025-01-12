@extends('layout.default')

@section('title','Ecommerce App-Home')
    
@section('content')

<main class="container" style="max-width: 900px">
<section>

 <div class="row mt-4">

  @if(session()->has('success'))
  <div class="alert alert-success">
  {{session()->get('success')}}
  </div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">
{{session()->get('error')}}
</div>
@endif

     @foreach ($cartItems as $cart)
<div class="col-12 mt-2"> 
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{$cart->image}}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"> <a href="{{route('product.details',$cart->slug)}}" style="text-decoration: none">
                {{$cart->title}}</a>  </h5>
              <p class="card-text">Price: {{$cart->price}}$ | Quantity: {{$cart->quantity}}</p>
             
            </div>
          </div>
        </div>
      </div>
   
</div>
    @endforeach 
</div> 
<div>
    {{$cartItems->links()}}
</div>
<div >
<a class="btn btn-primary" href="{{route('product.orders')}}">Check-Out</a>
</div>
</section>
</main>

@endsection