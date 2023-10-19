@extends('layouts.body')
@section('content')
    <h1 class="text-lg font-medium">
        {{ $title }}
    </h1>
    <p class="text-gray-600">
        {{ $action }}
    </p>
    <form action="{{ route('sales-order.update', $salesOrder) }}" method="post"id="add_mycart" class="inline">
        @method('put')
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="product_id" value="{{ $salesOrder->product_id }}">
        @if($salesOrder->status_so == "Diminta")
        <input type="hidden" name="status_so" value="Dikemas">
        @elseif($salesOrder->status_so == "Dikemas")
        <input type="hidden" name="status_so" value="Dikirim">
        <input type="hidden" name="sales_order_no" value="{{$salesOrder->sales_order_no}}">
        @elseif($salesOrder->status_so == 'Dikirim')
        <input type="hidden" name="status_so" value="Terkirim">
        <input type="hidden" name="sales_order_no" value="{{$salesOrder->sales_order_no}}">
        @endif
        <div class="grid grid-cols-12 gap-6 mt-5 box">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y p-5">
                    <div>
                        <label for="product_image" class="form-label font-bold">Product Image</label>
                        <div class="max-h-[50px] overflow-hidden">
                            <img src="{{ isset($salesOrder->product->product_image) ? asset('storage/assets/images/product/' . $salesOrder->product->product_image) : url('assets/images/product/' . $salesOrder->product->product_image) }}"
                                alt="Images Products" class="rounded">                           
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
                            value="{{ isset($salesOrder->product->product_name) ? $salesOrder->product->product_name : old('product_name') }}"
                            disabled>
                    </div>

                    <div class="mt-3">
                        <label for="product_price" class="form-label font-bold">Price</label>
                        <div class="input-group">
                            <div id="input-group-1" class="input-group-text">Rp</div>
                            <input id="product_price" id="product_price" name="product_price" type="text" required
                                class="form-control" placeholder="25000" aria-describedby="input-group-1"
                                value="{{ isset($salesOrder->product->product_price) ? number_format($salesOrder->product->product_price, 2, ',', '.') : old('product_price') }}"
                                disabled>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="product_minimum_stock" class="form-label font-bold">Stock Available </label>
                        <div class="input-group">
                            <input id="product_minimum_stock" id="product_minimum_stock" name="product_minimum_stock"
                                type="text" required class="form-control" aria-describedby="input-group-1"
                                value="{{ isset($amt_stock[0]->stock) ? number_format($amt_stock[0]->stock, 2, ',', '.'): number_format($salesOrder->product->product_stock, 2, ',', '.') }}"
                                disabled>
                                
                                <div id="input-group-1" class="input-group-text uppercase">{{ $salesOrder->product->unit->unit_name }}</div>
                            </div>
                            
                    </div>

                    <div class="mt-3">
                        <label for="user_id" class="form-label font-bold">Customer</label>
                        <input type="hidden" name="user_id" id="user_id" value="{{$salesOrder->user_id}}">
                        <input id="user_name" type="text" class="form-control w-full" name="user_name"
                            placeholder="1920123****" required
                            value="{{ isset($salesOrder->user->name) ? $salesOrder->user->name : old('user_name') }}"
                            autocomplete="off" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="detail_alamat" class="form-label font-bold">Detail Address</label>
                        <input id="detail_alamat" type="text" class="form-control w-full" name="detail_alamat"
                            placeholder="1920123****" required
                            value="{{ isset($salesOrder->detail_alamat) ? $salesOrder->detail_alamat : old('detail_alamat') }}"
                            autocomplete="off" readonly>
                    </div>
                    <div class="mt-3">
                        <label for="metode_bayar" class="form-label font-bold">Metode Bayar</label>
                        <input id="metode_bayar" type="text" class="form-control w-full" name="metode_bayar"
                            placeholder="1920123****" required
                            value="{{ isset($salesOrder->metode_bayar) ? $salesOrder->metode_bayar : old('metode_bayar') }}"
                            autocomplete="off" readonly>
                    </div>
                    <div class="mt-3">
                        <label for="date_bayar" class="form-label font-bold">Detail Address</label>
                        <input id="date_bayar" type="text" class="form-control w-full" name="date_bayar"
                            placeholder="1920123****" required
                            value="{{ isset($salesOrder->date_bayar) ? $salesOrder->date_bayar : old('date_bayar') }}"
                            autocomplete="off" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="product_code" class="form-label font-bold">Product Code</label>
                        <input id="product_code" type="text" class="form-control w-full" name="product_code"
                            placeholder="1920123****" required
                            value="{{ isset($salesOrder->product->product_code) ? $salesOrder->product->product_code : old('product_code') }}"
                            autocomplete="off" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="category_id" class="form-label font-bold">Category</label>
                        <input id="category" id="category" name="category" type="text" required class="form-control"
                            aria-describedby="input-group-1"
                            value="{{ isset($salesOrder->product->category) ? $salesOrder->product->category->category_name : old('category') }}"
                            disabled>
                    </div>
                    <div class="mt-3">
                        <label for="product_description" class="form-label font-bold">Product Description </label>
                        <textarea id="product_description" type="text" class="form-control w-full  editor" name="product_description"
                            placeholder="Description" required autocomplete="off" disabled>{{ isset($salesOrder->product->product_description) ? $salesOrder->product->product_description : old('product_description') }}</textarea>
                        @error('product_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="so_qty" class="form-label font-bold">Qty Sales Order </label>
                        <input type="hidden" name="so_qty" id="so_qty" value="{{$salesOrder->so_qty}}">
                        <input id="so_qty_view" id="so_qty_view" name="so_qty_view" type="number" required class="form-control"
                            aria-describedby="input-group-1" value="{{$salesOrder->so_qty}}" disabled>
                        @error('so_qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="message_so" class="form-label font-bold">Message </label>
                        <input id="message_so" id="message_so" name="message_so" type="text" required class="form-control"
                            aria-describedby="input-group-1" value="{{$salesOrder->message_so}}" readonly>
                        @error('so_qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="amt" class="form-label font-bold">Total Amount </label>
                        <input id="amt" id="amt" name="amt" type="text" required class="form-control"
                            aria-describedby="input-group-1" value="Rp {{number_format($salesOrder->total_amt, 0, ',', '.')}}" disabled>
                            <input type="hidden" name="total_amt" id="total_amt" value="{{$salesOrder->total_amt}}">
                        @error('qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="intro-y col-span-12 p-5">
                <div class="text-right mt-5">
                    
                    <a href="{{ url('/my-order') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                    @if($salesOrder->status_so == 'Diminta' || $salesOrder->status_so == 'Dikemas')
                    <button class="btn btn-primary w-36" id="Kemas" title="add to cart"><i
                            data-lucide="shopping-bag" class="w-4 h-4 mr-2"></i> {{$salesOrder->status_so == 'Diminta' ? 'Packing': 'Send'}}</button>
                    @elseif($salesOrder->status_so == 'Dikirim')
                    <button class="btn btn-primary w-36" id="Kemas" title="add to cart"><i
                        data-lucide="shopping-bag" class="w-4 h-4 mr-2"></i> {{$salesOrder->status_so == 'Dikirim' ? 'Accept Order': ''}}</button>
                   @endif
                </div>
            </div>
        </div>
    </form>

    <script>
        // const addcart = document.querySelector('#add-cart')
        // addcart.addEventListener('click', function(e) {
        //     const data = {

        //     }
        //     console.log(data)
        // })
    </script>
@endsection
