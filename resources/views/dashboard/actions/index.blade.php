@extends('layouts.admin')

@section('content')

<header class="relative z-40 bg-white shadow">
    <div class="flex flex-wrap justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
        <h1 class="text-xl font-bold leading-tight text-gray-900">Acciones</h1>
    </div>
</header>
<main class="w-full">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <list-actions :application_options="{{json_encode($application_options)}}"  :parent_actions="{{json_encode($parent_actions)}}"></list-actions>
    </div>
</main>

@endsection