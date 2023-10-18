@extends('layouts.body')
@section('content')
    <!-- Greet user with tailwiind  Hello, Name-->
    <h1 class="text-lg font-medium">
        {{ $title }}
    </h1>

    <!-- Welcome back -->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="sm:flex items-center sm:mr-4">
                <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Category</label>
                <select id="tabulator-html-filter-field" name="category_filter"
                    class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                    <option value="">ALL</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}" {{Request::get('category_filter') == $item->id ? 'selected' : ''}}>{{ $item->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="dropdown hidden">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                Print </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                Export to Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Page {{ $products->currentPage() }} | Total Data :
                {{ $products->total() }}</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500 hidden">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        @foreach ($products as $item)
            <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                <div class="box">
                    <div class="p-5">
                        <div
                            class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">

                            <img src="{{ isset($item->product_image) ? asset('storage/assets/images/product/' . $item->product_image) : url('assets/images/product/' . $item->product_image) }}"
                                alt="Images Products" class="rounded-md">

                            <span
                                class="absolute top-0 bg-pending/80 text-white text-xs m-5 px-2 py-1 rounded z-10">{{ $item->category->category_name }}</span>
                            <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> <a href=""
                                    class="block font-medium text-base">{{ $item->product_name }}</a> </div>
                        </div>
                        <div class="text-slate-600 dark:text-slate-500 mt-5">
                            <div class="flex items-center"> <i data-lucide="link" class="w-4 h-4 mr-2"></i> Price:
                                Rp{{ number_format($item->product_price, 2, ',', '.') }} </div>
                            <div class="flex items-center mt-2"> <i data-lucide="layers" class="w-4 h-4 mr-2"></i>Stock
                                Available: {{ $item->stock == null ? $item->product_stock : $item->stock }} </div>
                            <div class="flex items-center mt-2 uppercase"> <i data-lucide="check-square"
                                    class="w-4 h-4 mr-2"></i> Status: {{ $item->product_status }} </div>
                        </div>
                    </div>
                    <div
                        class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <a class="flex items-center text-primary mr-auto" href="{{ route('view-product.show', $item) }}"> <i
                                data-lucide="eye" class="w-4 h-4 mr-1"></i> Preview </a>
                        <a class="flex items-center mr-3" href="javascript:;"> <i data-lucide="check-square"
                                class="w-4 h-4 mr-1"></i> Add Cart </a>

                    </div>
                </div>
            </div>
        @endforeach

        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            {{ $products->links() }}
        </div>
        <!-- END: Pagination -->
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabulator-html-filter-field').on('change', function(e) {
                if(+e.target.value != ""){
                    window.location.href = '/view-product?category_filter='+e.target.value
                }else{
                    window.location.href = '/view-product'
                }
            })
        })
    </script>
@endsection
