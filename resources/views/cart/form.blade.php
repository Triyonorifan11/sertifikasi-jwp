@extends('layouts.body')
@section('content')
    <h1 class="text-lg font-medium">
        {{ $title }}
    </h1>
    <p class="text-gray-600">
        {{ $action }}
    </p>

    <form action="{{ route('sales-order.store') }}" method="post"id="order" class="inline">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="product_id" value="{{ $keranjang->product_id }}">
        <input type="hidden" name="keranjang_id" value="{{ $keranjang->id }}">
        <div class="grid grid-cols-12 gap-6 mt-5 box">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y p-5">
                    <div>
                        <label for="product_image" class="form-label font-bold">Product Image</label>
                        <div class="max-h-[50px] overflow-hidden">
                            @if (isset($keranjang))
                                <img src="{{ isset($keranjang->product->product_image) ? asset('storage/assets/images/product/' . $keranjang->product->product_image) : url('assets/images/product/' . $keranjang->product->product_image) }}"
                                    alt="Images Products" class="rounded">
                            @else
                                <img src="{{ url('assets/images/product/default.jpg') }}" alt="Images Products"
                                    class="rounded" id="img_show">
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
                            value="{{ isset($keranjang->product->product_name) ? $keranjang->product->product_name : old('product_name') }}"
                            disabled>
                    </div>

                    <div class="mt-3">
                        <label for="product_price" class="form-label font-bold">Price</label>
                        <div class="input-group">
                            <div id="input-group-1" class="input-group-text">Rp</div>
                            <input id="product_price" id="product_price" name="product_price" type="text" required
                                class="form-control" placeholder="25000" aria-describedby="input-group-1"
                                value="{{ isset($keranjang->product->product_price) ? number_format($keranjang->product->product_price, 2, ',', '.') : old('product_price') }}"
                                disabled>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="product_minimum_stock" class="form-label font-bold">Stock Available </label>
                        <div class="input-group">
                            <input id="product_minimum_stock" id="product_minimum_stock" name="product_minimum_stock"
                                type="text" required class="form-control" aria-describedby="input-group-1"
                                value="{{ isset($amt_stock->stock) ? $amt_stock->stock : $keranjang->product->product_stock }}"
                                disabled>
                            @error('product_minimum_stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            {{-- <div id="input-group-1" class="input-group-text uppercase">{{ $keranjang->product->unit->unit_name }}</div> --}}
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="product_code" class="form-label font-bold">Product Code</label>
                        <input id="product_code" type="text" class="form-control w-full" name="product_code"
                            placeholder="1920123****" required
                            value="{{ isset($keranjang->product->product_code) ? $keranjang->product->product_code : old('product_code') }}"
                            autocomplete="off" disabled>
                        @error('product_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="category_id" class="form-label font-bold">Category</label>
                        <input id="category" id="category" name="category" type="text" required class="form-control"
                            aria-describedby="input-group-1"
                            value="{{ isset($keranjang->product->category) ? $keranjang->product->category->category_name : old('category') }}"
                            disabled>
                    </div>
                    <div class="mt-3">
                        <label for="product_description" class="form-label font-bold">Product Description </label>
                        <textarea id="product_description" type="text" class="form-control w-full  editor" name="product_description"
                            placeholder="Description" required autocomplete="off" disabled>{{ isset($keranjang->product->product_description) ? $keranjang->product->product_description : old('product_description') }}</textarea>
                        @error('product_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="so_qty" class="form-label font-bold">Qty Checkout </label>
                        <input id="so_qty" name="so_qty" type="number" required class="form-control"
                            aria-describedby="input-group-1" value="{{ $keranjang->qty }}">
                        @error('so_qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="metode_bayar" class="form-label font-bold">Pilih Metode Bayar <span class="text-danger">*</span></label>
                        <select data-placeholder="Select" class="tom-select w-full" name="metode_bayar" id="metode_bayar" required>
                            <option value="" disabled selected>pilih</option>
                            <option value="ShopePay">ShopePay</option>
                            <option value="Dana">Dana</option>
                            <option value="Link Aja">Link Aja</option>
    
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="detail_alamat" class="form-label font-bold">Detail Addres <span class="text-danger">*</span></label>
                        <textarea id="detail_alamat" type="text" class="form-control w-full  editor" name="detail_alamat"
                            placeholder="Detail Address" required autocomplete="off">{{old('detail_alamat')}}</textarea>
                        @error('detail_alamat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="message_so" class="form-label font-bold">Pesan</label>
                        <input id="message_so" name="message_so" type="text" class="form-control"
                            aria-describedby="input-group-1" value="">
                        @error('message_so')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-span-12 p-5">
                <label for="product_description" class="form-label font-bold">Detail Checkout</label>
                <div class="alert alert-primary show mb-2" role="alert">
                    Total Yang dibayar : Rp <span id="total_bayar">{{number_format($total_price, 2, ',', '.')}}</span>
                </div>
                <input type="hidden" name="total_amt" id="total_amt" value="{{$total_price}}">
            </div>
            <div class="intro-y col-span-12 p-5">
                <div class="text-right mt-5">
                    <a href="{{ url('/keranjang') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                    <button class="btn btn-primary w-36" id="order" title="create order">Create Order</button>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        

        const qty = $('#so_qty')
        $('#so_qty').change(function(e) {
            const price = {{ $keranjang->product->product_price }}
            const hasil = price * e.target.value
            if(e.target.value < 0){
                $('#so_qty').val(0);
                $('#total_bayar').html(0);
                $('#total_amt').val(0)
            }else{
                $('#total_amt').val(hasil)
                $('#total_bayar').html(formatRupiah(hasil.toString()))
            }
        })
    </script>
@endsection
