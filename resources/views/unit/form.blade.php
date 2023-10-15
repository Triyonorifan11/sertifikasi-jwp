@extends('layouts.body')
@section('content')
<h1 class="text-lg font-medium">
    {{ $title }}
</h1>
<p class="text-gray-600">
    {{ $action }}
</p>

<form action="{{ isset($unit->id) ? route('unit.update',$unit) : route('unit.store') }}" method="post">
    @method(isset($unit->id) ? 'PUT' : 'POST')
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5 box">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="unit_name" class="form-label">Unit Name</label>
                    <input id="unit_name" type="text" class="form-control w-full" name="unit_name" placeholder="Input text" required value="{{isset($unit->unit_name) ? $unit->unit_name : old('unit_name')}}" autocomplete="off">
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