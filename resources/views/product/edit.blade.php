@extends('product.layout');

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit product {{ $product->name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.index') }}">Product List</a>
            </div>
        </div>
    </div>
    @include('notifications.error')
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Product Name" value="{{ $product->name }}" id="name">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="code">Product Code</label>
                <input type="text" name="code" class="form-control" placeholder="Product Code" value="{{ $product->code }}" id="code">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="details">Product Details</label>
                <textarea class="form-control" name="details" placeholder="Product Details" id="details">{{ $product->details }}</textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" class="form-control" placeholder="Product image" id="image">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Current Product Image</strong>
               <img alt="{{ $product->name }}" src="{{ URL::to($product->image) }}" width="100px" height="100px">
                <input type="hidden" name="old_image" value="{{ $product->image }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
