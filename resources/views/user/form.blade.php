@extends('layouts.body')
@section('content')
<h1 class="text-lg font-medium">
    {{ $title }}
</h1>
<p class="text-gray-600">
    {{ $action }}
</p>

<form action="{{ isset($user->id) ? route('user.update', $user) : route('user.store') }}" method="post">
    @method(isset($user->id) ? 'PUT' : 'POST')
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5 box">
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="name" class="form-label font-bold">Name <span class="text-danger">*</span></label>
                    <input id="name" type="text" class="form-control w-full" name="name" placeholder="Name" required value="{{ isset($user->name) ? $user->name : old('name') }}" autocomplete="off">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="username" class="form-label font-bold">Username <span class="text-danger">*</span></label>
                    <input id="username" type="text" class="form-control w-full" name="username" placeholder="username" required value="{{ isset($user->username) ? $user->username : old('username') }}" autocomplete="off">
                    @error('username')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label font-bold">Email <span class="text-danger">*</span></label>
                    <input id="email" type="email" class="form-control w-full" name="email" placeholder="email" required value="{{ isset($user->email) ? $user->email : old('email') }}" autocomplete="off">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 lg:col-span-6">
            <div class="intro-y p-5">
                <div>
                    <label for="password" class="form-label font-bold">Password @if(!isset($user->id))<span class="text-danger">*</span> @endif</label>
                    <input id="password" type="password" class="form-control w-full" name="password" placeholder="*****" @if(!isset($user->id)) required @endif value="{{ old('password') }}" autocomplete="off">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @if(isset($user->id))
                    <!-- add note blank if not change -->
                    <small class="text-gray-600"> <span class="text-danger">*</span> Leave blank if not change</small>
                    @endif
                </div>
                <div class="mt-3">
                    <label for="role_id" class="form-label font-bold">Role User</label>
                    <div class="">
                        <select data-placeholder="Select user role" class="tom-select w-full" name="role_id" id="role_id" required>
                            @foreach ($role_id as $role)
                            <option value="{{ $role->id }}" {{ isset($user->role_id) ? ($user->role_id == Hashids::decode( $role->id)[0] ? 'selected' : '') : old('role_id') }}>
                                {{ $role->role_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <label for="active" class="form-label font-bold">Active Status</label>
                    {{-- <div class="form-switch mt-2">
                            <input type="checkbox" id="active" name="active" class="form-check-input" value="" {{isset($user->active) ? 'checked': ''}}>
                    @error('active')
                    <span>{{$message}}</span>
                    @enderror
                </div> --}}
                <select data-placeholder="Select user active" class="tom-select w-full" name="active" id="active" required>
                    <option value="1" {{ isset($user->active) ? ($user->active == '1' ? 'selected' : '') : old('active') }}>
                        Active</option>
                    <option value="0" {{ isset($user->active) ? ($user->active == '0' ? 'selected' : '') : old('active') }}>
                        Inactive</option>

                </select>
                @error('active')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 p-5">
        <div class="text-right mt-5">
            <a href="{{ url('/user') }}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
            <button class="btn btn-primary w-24">Save</button>
        </div>
    </div>
    </div>
</form>
@endsection