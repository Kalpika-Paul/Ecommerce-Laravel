@extends('layout.default')

@section('title','Ecommerce App-Home')
    
@section('content')

<main class="container" style="max-width: 900px">
<section>
{{-- {{$product}} --}}
<img src="{{$product->image}}" alt="" width="100%">
@if (session()->has('success'))
<div class="alert alert-success">
    {{session()->get('success')}}
    </div>    
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
{{session("error")}}
</div>
@endif
<h1>{{$product->title}}</h1>
<p>{{$product->price}}</p>
<p>{{$product->des}}</p>
<a href="{{route('product.addToCart',$product->id)}}" class="btn btn-success">Add to cart</a>
</section>
</main>

@endsection