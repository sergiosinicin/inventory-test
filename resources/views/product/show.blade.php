@extends('product.layout');

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.index') }}">Product List</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <strong>Product Name</strong>
                <p>{{ $product->name }}</p>
            </div>
            <div class="form-group">
                <strong>Product Code</strong>
                <p>{{ $product->code }}</p>
            </div>
            <div class="form-group">
                <strong>Product Details</strong>
                <p>{{ $product->details }}</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="pull-left">
                <img alt="{{ $product->name }}" src="{{ URL::to($product->image) }}" width="300px" height="300px">
            </div>
        </div>
    </div>
@endsection
