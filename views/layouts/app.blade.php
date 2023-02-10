@extends('layouts.base')

@section('app')
    <main class="container mx-auto px-4 py-8">
        @include('elements.session-alerts')

        @yield('content')
    </main>
@endsection
