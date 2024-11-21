@extends('layout.default')

@section('title','Ecommerce App-Home')
    
@section('content')

<main class="container" style="max-width: 900px">
<section>

 <div class="row mt-4">
     @foreach ($products as $product)
<div class="col-12 col-md-6 col-lg-3"> 
    <div class="card p-2 shadow-sm">
        <img src="{{$product->image}}"  width="100%">
      <div> 
      <a href="{{route('product.details',$product->slug)}}" style="text-decoration: none">
      {{$product->title}}</a>  |
      <span>{{$product->price}}$</span>
      </div>
    </div>
</div>
    @endforeach 
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
</div> 

<div>
    {{$products->links()}}
</div>

</section>
</main>

@endsection