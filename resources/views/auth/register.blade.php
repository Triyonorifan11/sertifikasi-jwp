@include('layouts.header')

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{url('assets/images/app/logo.svg')}}">
                    <span class="text-white text-lg ml-3"> PIXELSHOP </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{url('assets/images/app/cashier.png')}}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Belanja Hemat dengan Pixelshop
                        <br>
                        sign in to your account.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        {{$title}}
                    </h2>

                    <form action="{{ url('/store_register') }}" method="post">
                        @method('POST')
                        @csrf
                        <div class="grid grid-cols-12 gap-12 mt-5 box">
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
                                                
                                                <option value="{{$role_id[0]->id}}">
                                                    {{$role_id[0]->role_name}}
                                                </option>
                                                
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
                                <a href="{{ url('/login') }}" class="btn btn-outline-secondary w-24 mr-1">login</a>
                                <button class="btn btn-primary w-24">Daftar</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    @include('layouts.footer')
