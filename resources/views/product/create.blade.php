@extends('product.layout');

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.index') }}">Product List</a>
            </div>
        </div>
    </div>
    @include('notifications.error')
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Product Name" id="name">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="code">Product Code</label>
                <input type="text" name="code" class="form-control" placeholder="Product Code" id="code">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="details">Product Details</label>
                <textarea class="form-control" name="details" placeholder="Product Details" id="details"></textarea>
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
