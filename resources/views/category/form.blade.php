@extends('layouts.body')
@section('content')
<h1 class="text-lg font-medium">
    {{ $title }}
</h1>
<p class="text-gray-600">
    {{ $action }}
</p>

<form action="{{ isset($category->id) ? route('category.update',$category) : route('category.store') }}" method="post">
    @method(isset($category->id) ? 'PUT' : 'POST')
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5 box">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="category_name" class="form-label">Category Name</label>
                    <input id="category_name" type="text" class="form-control w-full" name="category_name" placeholder="Input text" required value="{{isset($category->category_name) ? $category->category_name : old('category_name')}}" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="icon" class="form-label">Category Icon</label>
                    <input id="icon" name="icon" type="text" class="form-control w-full" placeholder="Input text" required value="{{isset($category->icon) ? $category->icon :old('icon')}}" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 p-5">
            <div class="text-right mt-5">
                <a href="{{url('/category')}}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                <button class="btn btn-primary w-24">Save</button>
            </div>
        </div>
    </div>
</form>
@endsection