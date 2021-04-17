@extends('layouts.auth')

@section('content')
<p>registrar usuario</p>
<!--<v-card tile class="col-span-3">
    <v-card-title class="text-center">Iniciar Sesión</v-card-title>
    <v-card-text>
        <form method="POST" action="{{ route('login') }}" class="block" novalidate>
            @csrf
            <v-text-field label="Correo Electrónico" id="email" name="email" type="email" value="{{ old('email') }}" @error('email') :error-messages="{{json_encode($message)}}" @enderror @error('email') :error-messages="{{json_encode($message)}}" @enderror></v-text-field>
            <v-text-field label="Contraseña" id="password" name="password" type="password" value="{{ old('password') }}" @error('password') :error-messages="{{json_encode($message)}}" @enderror></v-text-field>
            @if (Route::has('password.request'))<p class="mt-3"><small><a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a></small></p>@endif
            <v-btn color="primary" type="submit">Iniciar Sesión</v-btn>
        </form>
    </v-card-text>
</v-card>-->
@endsection