@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Add product form
    </div>
    <div class="card-body">
        <form action="" method="POST" class="addProductForm">
            @csrf

            <div class="form-group mb-2">
                <label for="name">Product name</label>
                <input type="text" name="name" id="name" placeholder="product name" class="form-control productName">
            </div>

            <div class="form-group mb-2">
                <label for="price">Product price</label>
                <input type="number" name="price" id="price" min="1" placeholder="product price" class="form-control productPrice">
            </div>

            <div class="form-group mb-2">
                <label for="quantity">Product quantity</label>
                <input type="number" name="quantity" id="quantity" min="0" placeholder="product quantity" class="form-control productQuantity">
            </div>
            <button class="btn btn-sm btn-success">Add</button>
        </form>
        <hr>

        <div>
            <h5>Products table</h5>
        </div>
        <table class="table table-striped productsTable">
            <thead>
                <tr>
                    <th>Product name</th>
                    <th>Quantity in stock</th>
                    <th>Price per item</th>
                    <th>Datetime submitted</th>
                    <th>Total value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="tbody">
               @foreach($products as $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product['price'] * $product['quantity'] }}</td>
                    <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr><td>Sum Total Value: <span class="sumTotalValue">{{$sum_total_value}}</span></td></tr></tfoot>
        </table>
    </div>
</div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js"></script>
<script src="{{ asset('/js/products.js') }}" defer>
</script>
@endpush
@endsection