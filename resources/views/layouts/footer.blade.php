<div id="failed-notification-content" class="toastify-content hidden flex"> <i class="text-danger" data-lucide="x-circle"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium title">Error</div>
        <div class="text-slate-500 mt-1 message"> Please check the fileld form. </div>
    </div>
</div> <!-- END: Failed Notification Content -->
<!-- success notification -->
<div id="success-notification-content" class="toastify-content hidden flex"> <i class="text-success" data-lucide="check-circle"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium title">Success</div>
        <div class="text-slate-500 mt-1 message"> Data has been saved successfully. </div>
    </div>
</div> <!-- END: Success Notification Content -->

<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2 data_name">
                        Do you really want to delete these data? 
                        <br>
                        This process cannot be undone.
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <form action="" method="post"id="form_delete" class="inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger w-24" id="delete_this">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->


<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="{{url('assets/js/app.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('error'))
        document.querySelector("#failed-notification-content .message").innerHTML = "{{session('error')}}";
        window.Toastify({
            node: $("#failed-notification-content").clone().removeClass("hidden")[0],
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true
        }).showToast();
        @endif
        @if(session('success'))
        document.querySelector("#success-notification-content .message").innerHTML = "{{session('success')}}";
        window.Toastify({
            node: $("#success-notification-content").clone().removeClass("hidden")[0],
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true
        }).showToast();
        @endif

    });

    function deleteDataConfirm(data){
        const data_delete = data;
        const delete_this = document.querySelector('#delete_this');
        const form_delete = document.querySelector('#form_delete');
        const url = window.location.pathname;
        form_delete.setAttribute('action', `${url}/${data_delete.id}`);
    }

    function formatRupiah(angka) {
            let separator = ".";
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return rupiah;
        }
</script>

<body />
<html />