@extends('layouts.body')
@section('content')
    <!-- Greet user with tailwiind  Hello, Name-->
    <div class="intro-y flex flex-col sm:flex-row items-center">
        <h2 class="text-lg font-medium mr-auto">
            {{ $title }}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2" id="print-page">Print</button>

        </div>
    </div>
    <!-- BEGIN: Invoice -->
    <div class="intro-y box overflow-hidden mt-5" id="invoice-order">
        <div class="border-b border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left">
            <div class="px-5 py-10 sm:px-20 sm:py-20">
                <div class="text-primary font-semibold text-3xl">INVOICE</div>
                <div class="mt-2"> Receipt <span class="font-medium">{{ $salesOrder->sales_order_no }}</span> </div>
                <div class="mt-1">{{ $salesOrder->created_at->format('d/M/Y') }}</div>
            </div>
            <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
                <div>
                    <div class="text-base text-slate-500">Client Details</div>
                    <div class="text-lg font-medium text-primary mt-2">{{ $salesOrder->user->name }}</div>
                    <div class="mt-1">{{ $salesOrder->user->email }}</div>
                </div>
                <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                    <div class="text-base text-slate-500">Payment to</div>
                    <div class="text-lg font-medium text-primary mt-2">PIXELSHOP</div>
                    <div class="mt-1">gudangpixel@gmail.com</div>
                </div>
            </div>
        </div>
        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">DESCRIPTION</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">QTY</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">PRICE</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b dark:border-darkmode-400">
                                <div class="font-medium whitespace-nowrap">{{ $salesOrder->product->product_name }}</div>
                                <div class="text-slate-500 text-sm mt-0.5 whitespace-nowrap">
                                    {{ $salesOrder->product->category->category_name }}</div>
                            </td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">{{ $salesOrder->so_qty }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">Rp
                                {{ number_format($salesOrder->product->product_price, 0, ',', '.') }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">Rp
                                {{ number_format($salesOrder->total_amt, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
            <div class="text-center sm:text-left mt-10 sm:mt-0">
                <div class="text-base text-slate-500">{{ $salesOrder->metode_bayar }}</div>
                <div class="text-lg text-primary font-medium mt-2">PIXELSHOP</div>
            </div>
            <div class="text-center sm:text-right sm:ml-auto">
                <div class="text-base text-slate-500">Total Amount</div>
                <div class="text-xl text-primary font-medium mt-2">Rp
                    {{ number_format($salesOrder->total_amt, 0, ',', '.') }}</div>
                {{-- <div class="mt-1">Taxes included</div> --}}
            </div>
        </div>
    </div>
    <!-- END: Invoice -->

    <script>
        const print_page = document.querySelector('#print-page');
        const invoiceorder = document.querySelector('#invoice-order');
        print_page.addEventListener('click', function(e) {
            let printContents = document.getElementById('invoice-order').innerHTML;
            let originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        })
    </script>
@endsection
