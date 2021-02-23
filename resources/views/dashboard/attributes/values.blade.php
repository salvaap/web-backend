@extends('layouts.admin')

@section('content')

<header class="relative z-40 bg-white shadow">
    <div class="flex flex-wrap justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl font-bold leading-tight text-gray-900">Valores para {{$attribute->name}}</h1>
    </div>
</header>
<main class="w-full">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <list-values :id="{{json_encode($attribute->id)}}" :attribute="{{json_encode($attribute)}}"></list-values>
    </div>
</main>

@endsection