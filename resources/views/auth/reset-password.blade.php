@extends('layouts.auth')

@section('content')
<v-card tile class="col-span-3">
    <v-card-title class="text-center">Restablecer contraseña</v-card-title>
    <v-card-text>
        <form method="POST" action="{{ route('password.confirm') }}" class="block" novalidate>
            @csrf
            <v-text-field label="Contraseña" id="password" name="password" type="password" value="{{ old('password') }}" @error('password') :error-messages="{{json_encode($message)}}" @enderror></v-text-field>
            <br>
            <v-btn tile color="primary" type="submit">Confirmar contraseña</v-btn>
        </form>
    </v-card-text>
</v-card>
@endsection