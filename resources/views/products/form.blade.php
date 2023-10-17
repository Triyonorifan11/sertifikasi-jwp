@extends('layouts.body')
@section('content')
<h1 class="text-lg font-medium">
    {{ $title }}
</h1>
<p class="text-gray-600">
    {{ $action }}
</p>

{{-- form add & delete --}}
<form action="{{ isset($product->id) ? route('products.update', $product) : route('products.store') }}" method="post" enctype="multipart/form-data">
    @method(isset($product->id) ? 'PUT' : 'POST')
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5 box">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="product_name" class="form-label font-bold">Product Name <span class="text-danger">*</span></label>
                    <input id="product_name" type="text" class="form-control w-full" name="product_name" placeholder="Buku A5" required value="{{ isset($product->product_name) ? $product->product_name : old('product_name') }}" autocomplete="off">
                    @error('product_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="product_price" class="form-label font-bold">Price <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div id="input-group-1" class="input-group-text">Rp</div>
                        <input id="product_price" id="product_price" name="product_price" type="text" required class="form-control" placeholder="25000" aria-describedby="input-group-1" value="{{ isset($product->product_price) ? $product->product_price : old('product_price') }}">
                        @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <label for="product_stock" class="form-label font-bold">Product Stock <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input id="product_stock" name="product_stock" id="product_stock" type="text" class="form-control" placeholder="100" aria-describedby="input-group-1" required value="{{ isset($product->product_stock) ? $product->product_stock : old('product_stock') }}">
                        <select data-placeholder="Select unit" class="tom-select w-full uppercase" name="unit_id" id="unit_id" required>
                            @foreach ($unit_id as $unit)
                            <option value="{{ $unit->id }}" {{ isset($product->unit_id) ? ($product->unit_id == Hashids::decode($unit->id)[0] ? 'selected' : '') : old('unit_id') }}>
                                {{ $unit->unit_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <label for="product_minimum_stock" class="form-label font-bold">Product Stock (min) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input id="product_minimum_stock" id="product_minimum_stock" name="product_minimum_stock" type="text" required class="form-control" placeholder="5" aria-describedby="input-group-1" value="{{ isset($product->product_minimum_stock) ? $product->product_minimum_stock : old('product_minimum_stock') }}">
                        @error('product_minimum_stock')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div id="input-group-1" class="input-group-text">PCS</div>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="product_image" class="form-label font-bold">Product Image <span class="text-danger">*</span></label>
                    <div class="max-h-[50px] overflow-hidden">
                        @if(isset($product))
                        <img src="{{ isset($product->product_image) ? asset('storage/assets/images/product/'.$product->product_image) : url('assets/images/product/'.$product->product_image) }}" alt="Images Products" class="rounded">
                        @else
                        <img src="{{url('assets/images/product/default.jpg')}}" alt="Images Products" class="rounded" id="img_show">
                        @endif
                    </div>
                    <input id="product_image" type="file" class="form-control w-full" name="product_image" value="{{ isset($product->product_image) ? $product->product_image : old('product_image') }}" autocomplete="off" onchange="img_load(event)">
                    @error('product_image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="product_code" class="form-label font-bold">Product Code <span class="text-danger">*</span></label>
                    <input id="product_code" type="text" class="form-control w-full" name="product_code" placeholder="1920123****" required value="{{ isset($product->product_code) ? $product->product_code : old('product_code') }}" autocomplete="off">
                    @error('product_code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="category_id" class="form-label font-bold">Category <span class="text-danger">*</span></label>
                    <div class="">
                        <select data-placeholder="Select category" class="tom-select w-full" name="category_id" id="category_id" required>
                            @foreach ($category_id as $cat)
                            <option value="{{ $cat->id }}" {{ isset($product->category_id) ? ($product->category_id == $cat->id ? 'selected' : '') : old('category_id') }}>
                                {{ $cat->category_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <label for="amt_stock" class="form-label font-bold">Amount Stok <span class="text-danger">*</span></label>
                    <input id="amt_stock" type="text" class="form-control w-full" name="amt_stock" readonly value="{{ isset($amt_stock[0]->stock) ? $amt_stock[0]->stock : 0 }}" autocomplete="off">

                </div>
                <div class="mt-3">
                    <label for="product_description" class="form-label font-bold">Product Description <span class="text-danger">*</span></label>
                    <textarea id="product_description" type="text" class="form-control w-full  editor" name="product_description" placeholder="Description" required autocomplete="off">{{ isset($product->product_description) ? $product->product_description : old('product_description') }}</textarea>
                    @error('product_description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="active" class="form-label font-bold">Status <span class="text-danger">*</span></label>
                    {{-- <div class="form-switch mt-2">
                            <input type="checkbox" id="product_status" name="product_status" class="form-check-input" value="active" {{isset($product->product_status) ? $product->product_status ? 'checked': '' : ''}}>
                    @error('active')
                    <span>{{$message}}</span>
                    @enderror
                </div> --}}
                <div>
                    <select data-placeholder="Select product active" class="tom-select w-full" name="product_status" id="product_status" required>
                        <option value="active" {{ isset($product->product_status) ? ($product->product_status == 'active' ? 'selected' : '') : old('product_status') }}>
                            Active</option>
                        <option value="inactive" {{ isset($product->product_status) ? ($product->product_status == 'inactive' ? 'selected' : '') : old('product_status') }}>
                            Inactive</option>

                    </select>
                </div>
                @error('active')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 p-5">
        <div class="text-right mt-5">
            <a href="{{ url('/products') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
            <button class="btn btn-primary w-24">Save</button>
        </div>
    </div>
    </div>
</form>

<script>
    const img_load = function(e){
        let img_show = document.getElementById('img_show');
        img_show.src = URL.createObjectURL(e.target.files[0]);
        img_show.onload = function(){
            URL.revokeObjectURL(img_show.src)
        }
    }
</script>
@endsection