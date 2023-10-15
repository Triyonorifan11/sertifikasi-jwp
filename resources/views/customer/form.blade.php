@extends('layouts.body')
@section('content')
    <h1 class="text-lg font-medium">
        {{ $title }}
    </h1>
    <p class="text-gray-600">
        {{ $action }}
    </p>

    <form action="{{ isset($customer->id) ? route('customer.update', $customer) : route('customer.store') }}" method="post">
        @method(isset($customer->id) ? 'PUT' : 'POST')
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5 box">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y p-5">
                    <div>
                        <label for="customer_name" class="form-label font-bold">Customer Name <span
                                class="text-danger">*</span></label>
                        <input id="customer_name" type="text" class="form-control w-full" name="customer_name"
                            placeholder="Customer name" required
                            value="{{ isset($customer->customer_name) ? $customer->customer_name : old('customer_name') }}"
                            autocomplete="off">
                    </div>
                    <div class="mt-3">
                        <label for="customer_address" class="form-label font-bold">Customer Address</label>
                        <input id="customer_address" type="text" class="form-control w-full" name="customer_address"
                            placeholder="JL Surabaya UPN" required
                            value="{{ isset($customer->customer_address) ? $customer->customer_address : old('customer_address') }}"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <div class="intro-y p-5">
                    <div>
                        <label for="customer_phone" class="form-label font-bold">Customer Phone</label>
                        <input id="customer_phone" type="text" class="form-control w-full" name="customer_phone"
                            placeholder="08901XXX"
                            value="{{ isset($customer->customer_phone) ? $customer->customer_phone : old('customer_phone') }}"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="intro-y col-span-12 p-5">
                <div class="text-right mt-5">
                    <a href="{{ url('/customer') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                    <button class="btn btn-primary w-24">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
