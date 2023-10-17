@extends('layouts.body')
@section('content')
<h1 class="text-lg font-medium">
    {{ $title }}
</h1>
<p class="text-gray-600">
    {{ $action }}
</p>

<form action="{{ isset($po->id) ? route('purchase-order.update',$po) : route('purchase-order.store') }}" method="post">
    @method(isset($po->id) ? 'PUT' : 'POST')
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5 box">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div class="">
                    <label for="product_id" class="form-label font-bold">Pilih Produk <span class="text-danger">*</span></label>
                    <div class="">
                        <select data-placeholder="Select product" class="tom-select w-full" name="product_id" id="product_id" required>
                            @foreach ($product as $item)
                            <option value="{{ $item->id }}" {{ isset($po->product_id) ? ($po->product_id == Hashids::decode( $item->id)[0] ? 'selected' : '') : old('product_id') }}>
                                {{ $item->product_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <label for="po_qty" class="form-label font-bold">Quantity Produk <span class="text-danger">*</span></label>
                    <input id="po_qty" type="number" class="form-control w-full" name="po_qty" placeholder="100" required value="{{isset($unit->po_qty) ? $unit->po_qty : old('po_qty')}}" autocomplete="off">
                </div>
                <div class="mt-3">
                    <label for="description" class="form-label font-bold">Deskription</label>
                    <input id="description" type="text" class="form-control w-full" name="description" placeholder="Input text"  value="{{isset($unit->description) ? $unit->description : old('description')}}" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 p-5">
            <div class="text-right mt-5">
                <a href="{{url('/unit')}}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                <button class="btn btn-primary w-24">Save</button>
            </div>
        </div>
    </div>
</form>
@endsection