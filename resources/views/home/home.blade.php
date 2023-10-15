@extends('layouts.body')
@section('content')
<!-- Greet user with tailwiind  Hello, Name-->
<h1 class="text-lg font-medium">
    Hello, {{ Auth::user()->name }}.
</h1>
<!-- Welcome back -->
<p class="text-gray-600">
    Welcome back to your web application.
</p>

@endsection
