@extends('layouts.body')
@section('content')
    <!-- Greet user with tailwiind  Hello, Name-->
    <h1 class="text-lg font-medium">
        {{ $title }}
    </h1>

    <!-- Welcome back -->
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
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
            <div class="hidden md:block mx-auto text-slate-500"> Total Data :
                {{ $products->total() }}</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500 hidden">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible overflow-x-auto scrollbar-hidden">
            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
                <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto" >
                    <div class="sm:flex items-center sm:mr-4">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Field</label>
                        <select id="tabulator-html-filter-field" class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                            <option value="product_name">Name</option>
                            <option value="product_code">Code</option>
                        </select>
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Type</label>
                        <select id="tabulator-html-filter-type" class="form-select w-full mt-2 sm:mt-0 sm:w-auto" >
                            <option value="like" selected>like</option>
                            <option value="=">=</option>
                            <option value="<">&lt;</option>
                            <option value="<=">&lt;=</option>
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="!=">!=</option>
                        </select>
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                        <input id="tabulator-html-filter-value" type="text" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                    </div>
                    <div class="mt-2 xl:mt-0">
                        <button id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16" >Go</button>
                        <button id="tabulator-html-filter-reset" type="button" class="btn btn-secondary w-full sm:w-16 mt-2 sm:mt-0 sm:ml-1" >Reset</button>
                    </div>
                </form>
                <div class="flex mt-5 sm:mt-0">
                    <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </button>
                    <div class="dropdown w-1/2 sm:w-auto">
                        <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-auto sm:ml-2"></i> </button>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a id="tabulator-export-csv" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export CSV </a>
                                </li>
                                <li>
                                    <a id="tabulator-export-json" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export JSON </a>
                                </li>
                                <li>
                                    <a id="tabulator-export-xlsx" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export XLSX </a>
                                </li>
                                <li>
                                    <a id="tabulator-export-html" href="javascript:;" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export HTML </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table_product" class="mt-5 table-report table-report--tabulator"></div>
            
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        
        <!-- END: Pagination -->
    </div>

    <!-- Development version -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Production version -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        if ($("#table_product").length) {
            let table = new Tabulator("#table_product", {
                ajaxURL: "{{url('/api/my-cart/getDataTable')}}",
                ajaxFiltering: true,
                ajaxSorting: true,
                printAsHtml: true,
                printStyled: true,
                pagination: "remote",
                paginationSize: 10,
                paginationSizeSelector: [10, 20, 30, 40],
                layout: "fitColumns",
                responsiveLayout: "collapse",
                placeholder: "No matching records found",
                columns: [{
                        formatter: "responsiveCollapse",
                        width: 40,
                        minWidth: 30,
                        hozAlign: "center",
                        resizable: false,
                        headerSort: false,
                    },

                    // For HTML table
                    {
                        title: "PRODUCT NAME",
                        minWidth: 200,
                        responsive: 0,
                        field: "product_name",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div>
                            <div class="font-medium whitespace-nowrap">${
                                cell.getData().product_name
                            }</div>
                        </div>`;
                        },
                    },
                    {
                        title: "IMAGES",
                        minWidth: 200,
                        field: "images",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="Midone - HTML Admin Template" class="rounded-full" src="storage/assets/images/product/${
                                    cell.getData().product_image
                                }">
                            </div>
                        </div>`;
                        },
                    },
                    {
                        title: "STOCK INPUT",
                        minWidth: 200,
                        field: "product_stock",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false
                    },
                    {
                        title: "STOCK TOTAL",
                        minWidth: 200,
                        field: "stock",
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                    },
                    
                    {
                        title: "ACTIONS",
                        minWidth: 200,
                        field: "actions",
                        responsive: 1,
                        hozAlign: "center",
                        vertAlign: "middle",
                        print: false,
                        download: false,
                        formatter(cell, formatterParams) {
                            let a =
                                $(`<div class="flex lg:justify-center items-center">
                            <a class="delete flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </a>
                        </div>`);
                        $(a)
                            .find(".delete")
                            .on("click", function () {
                                deleteDataConfirm(cell.getData())
                            });
                        return a[0];
                        },
                    },

                    // For print format
                    {
                        title: "PRODUCT NAME",
                        field: "product_name",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "CODE",
                        field: "product_code",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "REMAINING STOCK",
                        field: "stock",
                        visible: false,
                        print: true,
                        download: true,
                    },
                    {
                        title: "STATUS",
                        field: "product_status",
                        visible: false,
                        print: true,
                        download: true,
                        formatterPrint(cell) {
                            return cell.getValue() ? "Active" : "Inactive";
                        },
                    },
                    {
                        title: "IMAGE 1",
                        field: "product_image",
                        visible: false,
                        print: true,
                        download: true,
                        formatterPrint(cell) {
                            return cell.getValue()[0];
                        },
                    },
                    
                ],
                
               
            });
       
        // Filter function
        function filterHTMLForm() {
            let field = $("#tabulator-html-filter-field").val();
            let type = $("#tabulator-html-filter-type").val();
            let value = $("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        $("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        $("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        $("#tabulator-html-filter-reset").on("click", function (event) {
            $("#tabulator-html-filter-field").val("product_name");
            $("#tabulator-html-filter-type").val("like");
            $("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        $("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        $("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        $("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        $("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        $("#tabulator-print").on("click", function (event) {
            table.print();
        });
        }
    </script>
@endsection
