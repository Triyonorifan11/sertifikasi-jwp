@extends('layouts.body')
@section('content')
    <h1 class="text-lg font-medium">
        {{ $title }}
    </h1>
    <p class="text-gray-600">
        {{ $action }}
    </p>

    <form action="{{ isset($supplier->id) ? route('supplier.update', $supplier) : route('supplier.store') }}" method="post">
        @method(isset($supplier->id) ? 'PUT' : 'POST')
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5 box">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y p-5">
                    <div>
                        <label for="supplier_name" class="form-label font-bold">Supplier Name <span
                                class="text-danger">*</span></label>
                        <input id="supplier_name" type="text" class="form-control w-full" name="supplier_name"
                            placeholder="supplier name" required
                            value="{{ isset($supplier->supplier_name) ? $supplier->supplier_name : old('supplier_name') }}"
                            autocomplete="off">
                    </div>
                    <div class="mt-3">
                        <label for="supplier_address" class="form-label font-bold">Supplier Address</label>
                        <input id="supplier_address" type="text" class="form-control w-full" name="supplier_address"
                            placeholder="JL Surabaya UPN" required
                            value="{{ isset($supplier->supplier_address) ? $supplier->supplier_address : old('supplier_address') }}"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y p-5">
                    <div>
                        <label for="supplier_phone" class="form-label font-bold">Supplier Phone</label>
                        <input id="supplier_phone" type="text" class="form-control w-full" name="supplier_phone"
                            placeholder="08901XXX"
                            value="{{ isset($supplier->supplier_phone) ? $supplier->supplier_phone : old('supplier_phone') }}"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 p-5">
                <div class="text-right mt-5">
                    <a href="{{ url('/supplier') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                    <button class="btn btn-primary w-24">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
