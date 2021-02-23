@extends('layouts.admin')

@section('content')

<header class="relative z-40 bg-white shadow">
    <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl font-bold leading-tight text-gray-900">Agregar Producto</h1>
    </div>
</header>
<main class="w-full">
    <create-product :categories="{{ json_encode($categories) }}" :attributes="{{ json_encode($attributes) }}" :conditions="{{ json_encode($conditions) }}" :weight_ranges="{{ json_encode($weight_ranges) }}"></create-product>
</main>

@endsection