@extends('product.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.create') }}">Create New Product</a>
            </div>
        </div>

        @include('notifications.success')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Details</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ str_limit($item->details,100) }}</td>
                    <td><img alt="{{ $item->name }}" src="{{ URL::to($item->image) }}" width="100px" height="100px"/></td>
                    <td>
                        <a class="btn btn-info" href="{{ route('product.show', $item->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('product.edit', $item->id ) }}">Edit</a>
                        <div class="pull-right">
                        <form method="POST" action="{{ route('product.destroy', $item->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                   value="Delete"/>
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
