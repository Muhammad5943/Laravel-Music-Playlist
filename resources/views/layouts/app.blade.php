@extends('layouts.base')

@section('baseStyles')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('baseScripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

@section('body')
    <x-navbar></x-navbar>

    <div class="mt-4">
        @yield('content')
    </div>

    <footer class="mt-5 border-top py-5">
        <div class="container">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt facere assumenda nobis. Consequatur rerum dolorum ex consequuntur expedita quaerat id, quod iste dolor unde incidunt totam assumenda deserunt vero ea.
            Eligendi neque aperiam repudiandae tenetur magni quos, vero rem incidunt, natus asperiores commodi sit doloremque atque enim et. Quaerat doloremque blanditiis numquam aut facilis, aliquam possimus dolorum deserunt ullam omnis?
            Repudiandae, provident laboriosam vitae quisquam officiis harum a, quam exercitationem assumenda corporis porro atque! Ipsum expedita nesciunt illum sunt? Perspiciatis pariatur, magni dolores quis ad exercitationem? Labore magni nam quis.
            Delectus placeat mollitia nesciunt laborum neque numquam distinctio quo sed? Explicabo, placeat minus culpa dignissimos mollitia doloribus! Commodi soluta quisquam maxime ratione praesentium corporis nulla, corrupti, iste perspiciatis repellat mollitia.
            Quaerat quae ipsam dicta nam saepe perspiciatis enim, autem odit nihil rem exercitationem, minus alias magnam aliquid. Eaque aliquid odio sint, commodi impedit et. Corrupti omnis eligendi repellat. Perspiciatis, facere.
        </div>
    </footer>
@endsection