@extends('layouts.body')
@section('content')
    <h1 class="text-lg font-medium">
        {{ $title }}
    </h1>
    <p class="text-gray-600">
        {{ $action }}
    </p>

    <div class="grid grid-cols-12 gap-6 mt-5 box">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="product_image" class="form-label font-bold">Product Image</label>
                    <div class="max-h-[50px] overflow-hidden">
                        @if (isset($product))
                            <img src="{{ isset($product->product_image) ? asset('storage/assets/images/product/' . $product->product_image) : url('assets/images/product/' . $product->product_image) }}"
                                alt="Images Products" class="rounded">
                        @else
                            <img src="{{ url('assets/images/product/default.jpg') }}" alt="Images Products" class="rounded"
                                id="img_show">
                        @endif
                    </div>
                </div>


            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div class="mt-3">
                    <label for="product_name" class="form-label font-bold">Product Name </label>
                    <input id="product_name" id="product_name" name="product_name" type="text" required
                        class="form-control" placeholder="25000" aria-describedby="input-group-1"
                        value="{{ isset($product->product_name) ? $product->product_name : old('product_name') }}" disabled>
                </div>

                <div class="mt-3">
                    <label for="product_price" class="form-label font-bold">Price</label>
                    <div class="input-group">
                        <div id="input-group-1" class="input-group-text">Rp</div>
                        <input id="product_price" id="product_price" name="product_price" type="text" required
                            class="form-control" placeholder="25000" aria-describedby="input-group-1"
                            value="{{ isset($product->product_price) ? number_format($product->product_price, 2, ',', '.') : old('product_price') }}"
                            disabled>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="product_minimum_stock" class="form-label font-bold">Stock Available </label>
                    <div class="input-group">
                        <input id="product_minimum_stock" id="product_minimum_stock" name="product_minimum_stock"
                            type="text" required class="form-control" aria-describedby="input-group-1"
                            value="{{ isset($product->stock) ? $product->stock : old('product_minimum_stock') }}" disabled>
                        @error('product_minimum_stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div id="input-group-1" class="input-group-text uppercase">{{ $product->unit->unit_name }}</div>
                    </div>
                </div>
                <div class="mt-3">


                </div>

                <div class="mt-3">
                    <label for="product_code" class="form-label font-bold">Product Code</label>
                    <input id="product_code" type="text" class="form-control w-full" name="product_code"
                        placeholder="1920123****" required
                        value="{{ isset($product->product_code) ? $product->product_code : old('product_code') }}"
                        autocomplete="off" disabled>
                    @error('product_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="category_id" class="form-label font-bold">Category</label>
                    <input id="categoru" id="categoru" name="categoru" type="text" required class="form-control"
                        aria-describedby="input-group-1"
                        value="{{ isset($product->category) ? $product->category->category_name : old('categoru') }}"
                        disabled>
                </div>
                <div class="mt-3">
                    <label for="product_description" class="form-label font-bold">Product Description </label>
                    <textarea id="product_description" type="text" class="form-control w-full  editor" name="product_description"
                        placeholder="Description" required autocomplete="off" disabled>{{ isset($product->product_description) ? $product->product_description : old('product_description') }}</textarea>
                    @error('product_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="intro-y col-span-12 p-5">
            <div class="text-right mt-5">
                <a href="{{ url('/view-product') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                <button class="btn btn-primary w-36" id="add-cart" title="add to cart"><i data-lucide="shopping-bag" class="w-4 h-4"></i></button>
            </div>
        </div>
    </div>

    <script>
        const img_load = function(e) {
            let img_show = document.getElementById('img_show');
            img_show.src = URL.createObjectURL(e.target.files[0]);
            img_show.onload = function() {
                URL.revokeObjectURL(img_show.src)
            }
        }
    </script>
@endsection
