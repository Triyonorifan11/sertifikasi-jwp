@include('layouts.header')

<body class="main">
    <div class="container">
        <!-- BEGIN: Error Page -->
        <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
            <div class="-intro-x lg:mr-20">
                <img class="h-48 lg:h-auto" src="{{url('assets/images/app/error-illustration.svg')}}">
            </div>
            <div class="text-white mt-10 lg:mt-0">
                <div class="intro-x text-8xl font-medium">404</div>
                <div class="intro-x text-xl lg:text-3xl font-medium mt-5">Oops. This page has gone missing</div>
                <div class="intro-x text-lg mt-3">You may have mistyped the address or the page may have moved.</div>
                <!-- ADD MESSAGE WILL BE REDIRECT  -->
                <div class="intro-x mt-10 sm:mt-20">
                    <div class="intro-x text-sm mt-3">You will be redirected to home in <span id="countdown">5</span> seconds.</div>
                </div>
                <a href="route('home')" class="intro-x btn py-3 px-4 text-white border-white dark:border-darkmode-400 dark:text-slate-200 mt-10">Back to Home</a>
            </div>
        </div>
        <!-- END: Error Page -->
    </div>
    <!-- add javascript auto redirect home in 5 seconds -->
    <script>
        var timeleft = 5;
        var downloadTimer = setInterval(function() {
            document.getElementById("countdown").innerHTML = timeleft;
            timeleft -= 1;
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                window.location.href = "{{route('home')}}";
            }
        }, 1000);
    </script>
    @include('layouts.footer')