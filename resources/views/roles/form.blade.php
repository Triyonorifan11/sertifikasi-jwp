@extends('layouts.body')
@section('content')
<h1 class="text-lg font-medium">
    {{ $title }}
</h1>
<p class="text-gray-600">
    {{ $action }}
</p>

<form action="{{ isset($role->id) ? route('roles.update',$role) : route('roles.store') }}" method="post">
    @method(isset($role->id) ? 'PUT' : 'POST')
    @csrf
    <div class="grid grid-cols-12 gap-6 mt-5 box">
        <div class="pt-5 col-span-12 lg:col-span-6">
            <div class="px-5">
                <div>
                    <label for="role_name" class="form-label">Role Name</label>
                    <input id="role_name" type="text" class="form-control w-full" name="role_name" placeholder="Input text" required value="{{isset($role->role_name) ? $role->role_name : old('role_name')}}" autocomplete="off">
                    @error('role_name')
                    <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="pt-5 col-span-12 lg:col-span-6">
            <div class="px-5">
                <div>
                    <label for="role_description" class="form-label">Role Description</label>
                    <input id="role_description" type="text" class="form-control w-full" name="role_description" placeholder="Input text" required value="{{isset($role->role_name) ? $role->role_name : old('role_name')}}" autocomplete="off">
                    @error('role_description')
                    <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <!-- add check all -->
        <div class="col-span-12 lg:col-span-12">
            <div class="px-5">
                <div class="form-check mt-4"> <input class="check_all" id="all" class="form-check-input" type="checkbox"> <label class="form-check-label font-bold" for="all">Select All</label> </div>
            </div>
        </div>
        <!-- make checkbox parent master and child role,unit,product -->
        <div class="col-span-12 lg:col-span-4">
            <div class="px-5">
                <div class="form-check"> <input class="check_parent_role" id="master" class="form-check-input" type="checkbox"> <label class="form-check-label font-semibold" for="master">Master</label> </div>
                <div class="check-child pl-3">
                    <div class="form-check mt-2"> <input @if(isset($role->master_category) ? $role->master_category : false) checked @endif id="master_categpry" name="master_category" class="form-check-input" type="checkbox" > <label class="form-check-label" for="master_categpry">Category</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->master_unit) ? $role->master_unit : false) checked @endif id="master_unit" name="master_unit" class="form-check-input" type="checkbox" > <label class="form-check-label" for="master_unit">Unit</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->master_supplier) ? $role->master_supplier : false) checked @endif id="master_supplier" name="master_supplier" class="form-check-input" type="checkbox" > <label class="form-check-label" for="master_supplier">Supplier</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->master_customer) ? $role->master_customer : false) checked @endif id="master_customer" name="master_customer" class="form-check-input" type="checkbox" > <label class="form-check-label" for="master_customer">Customer</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->master_product) ? $role->master_product : false) checked @endif id="master_product" name="master_product" class="form-check-input" type="checkbox" > <label class="form-check-label" for="master_product">Product</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->master_role) ? $role->master_role : false) checked @endif id="master_role" name="master_role" class="form-check-input" type="checkbox" > <label class="form-check-label" for="master_role">Role</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->master_user) ? $role->master_user : false) checked @endif id="master_user" name="master_user" class="form-check-input" type="checkbox" > <label class="form-check-label" for="master_user">User</label> </div>
                </div>

            </div>
        </div>
        <div class="col-span-12 lg:col-span-4">
            <div class="px-5">
                <div class="form-check mt-4"> <input class="check_parent_role" id="transaction" class="form-check-input" type="checkbox"> <label class="form-check-label  font-semibold" for="transaction">Transaction</label> </div>
                <div class="check-child pl-3">
                    <div class="form-check mt-2"> <input @if(isset($role->purchase_order) ? $role->purchase_order : false) checked @endif id="puchase_order" name="purchase_order" class="form-check-input" type="checkbox" > <label class="form-check-label" for="puchase_order">Purchase Order</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->sales_order) ? $role->sales_order : false) checked @endif id="sales_order" name="sales_order" class="form-check-input" type="checkbox" > <label class="form-check-label" for="sales_order">Sales Order</label> </div>
                </div>

            </div>
        </div>
        <div class="col-span-12 lg:col-span-4">
            <div class="px-5">
                <div class="form-check mt-4"> <input class="check_parent_role" id="report" class="form-check-input" type="checkbox"> <label class="form-check-label font-semibold" for="report">Report</label> </div>
                <div class="check-child pl-3">
                    <div class="form-check mt-2"> <input @if(isset($role->report_purchase_order) ? $role->report_purchase_order : false) checked @endif id="report_purchase_order" name="report_purchase_order" class="form-check-input" type="checkbox" > <label class="form-check-label" for="report_purchase_order">Purchase Order</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->report_sales_order) ? $role->report_sales_order : false) checked @endif id="report_sales_order" name="report_sales_order" class="form-check-input" type="checkbox" > <label class="form-check-label" for="report_sales_order">Sales Order</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->report_stock) ? $role->report_stock : false) checked @endif id="report_stock" name="report_stock" class="form-check-input" type="checkbox" > <label class="form-check-label" for="report_stock">Stock</label> </div>
                    <div class="form-check mt-2"> <input @if(isset($role->report_profit_loss) ? $role->report_profit_loss : false) checked @endif id="report_profit_loss" name="report_profit_loss" class="form-check-input" type="checkbox" > <label class="form-check-label" for="report_profit_loss">Profit/Loss</label> </div>
                </div>

            </div>
        </div>

        <div class="intro-y col-span-12 p-5">
            <div class="text-right mt-5">
                <a href="{{url('/roles')}}" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                <button class="btn btn-primary w-24">Save</button>
            </div>
        </div>
    </div>
</form>
<script>
    var check_parent_role = document.querySelectorAll('.check_parent_role');
    var check_all = document.querySelector('.check_all');

    function checkAllParentChecked() {
        var checkedAll = true;
        check_parent_role.forEach(function(check) {
            var check_child = check.parentElement.parentElement.querySelector('.check-child');
            var checked = true;
            check_child.querySelectorAll('input').forEach(function(child) {
                if (!child.checked) {
                    checked = false;
                }
            });
            check.checked = checked;
            if (!checked) {
                checkedAll = false;
            }
        });
        check_all.checked = checkedAll;
    }

    checkAllParentChecked();
    document.addEventListener('DOMContentLoaded', function() {
        // checkbox all
        check_all.addEventListener('click', function() {
            var check_parent_role = document.querySelectorAll('.check_parent_role');
            if (this.checked) {
                check_parent_role.forEach(function(check) {
                    check.checked = true;
                    var check_child = check.parentElement.parentElement.querySelector('.check-child');
                    check_child.querySelectorAll('input').forEach(function(child) {
                        child.checked = true;
                    });
                });
            } else {
                check_parent_role.forEach(function(check) {
                    check.checked = false;
                    var check_child = check.parentElement.parentElement.querySelector('.check-child');
                    check_child.querySelectorAll('input').forEach(function(child) {
                        child.checked = false;
                    });
                });
            }
        });
    })


    // checkbox parent
    check_parent_role.forEach(function(check) {
        check.addEventListener('click', function() {
            var check_child = this.parentElement.parentElement.querySelector('.check-child');
            if (this.checked) {
                check_child.querySelectorAll('input').forEach(function(child) {
                    child.checked = true;
                });
            } else {
                check_child.querySelectorAll('input').forEach(function(child) {
                    child.checked = false;
                });
            }
            checkAllParentChecked();
        });
    });
    // checkbox child
    var check_child = document.querySelectorAll('.check-child input');
    check_child.forEach(function(check) {
        check.addEventListener('click', function() {
            var check_parent_role = this.parentElement.parentElement.parentElement.querySelector('.check_parent_role');
            if (this.checked) {
                var check_child = this.parentElement.parentElement.querySelectorAll('input');
                var checked = true;
                check_child.forEach(function(child) {
                    if (!child.checked) {
                        checked = false;
                    }
                });
                if (checked) {
                    check_parent_role.checked = true;
                }
            } else {
                check_parent_role.checked = false;
            }
            checkAllParentChecked();
        });
    });
</script>
@endsection