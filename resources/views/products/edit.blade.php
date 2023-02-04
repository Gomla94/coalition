@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Edit product form
    </div>
    <div class="card-body">
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">               
                {{ Session::get('error') }}
            </div>
    @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="editProductForm">
            <input type="hidden" class="productId" value="{{ $product->id }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-2">
                <label for="name">Product name</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" placeholder="product name" class="form-control productName">
            </div>

            <div class="form-group mb-2">
                <label for="price">Product price</label>
                <input type="number" name="price" id="price" value="{{ $product->price }}" min="1" placeholder="product price" class="form-control productPrice">
            </div>

            <div class="form-group mb-2">
                <label for="quantity">Product quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" min="0" placeholder="product quantity" class="form-control productQuantity">
            </div>
            <button class="btn btn-sm btn-info">Edit</button>
        </form>
    </div>
</div>

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js"></script>
<script src="{{ asset('/js/products.js') }}" defer>
</script>
<script defer>
    const alert = document.querySelector('.alert');
    setTimeout(() => {
        if(alert) {
            alert.remove()
        }
    }, 1500);
</script>
@endpush
@endsection