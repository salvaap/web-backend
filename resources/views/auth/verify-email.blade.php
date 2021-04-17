@extends('layouts.auth')

@section('content')
<v-card tile class="col-span-3">
    <v-card-title class="text-center">Restablecer contraseña</v-card-title>
    <v-card-text>
        @if (session('resent'))
        <v-alert type="success">
            Un nuevo enlace de verificación ha sido enviado a tu dirección de correo electrónico.
        </v-alert>
        @endif
        <h4>Antes de proceder, porfavor revisa tu correo electrónico por un enlace de verificación.</h4>
        <hr>
        <h4>En caso que no hayas recibido el correo.</h4>
        <form method="POST" action="{{ route('verification.resend') }}" class="block" novalidate>
            @csrf
            <v-btn tile color="primary" type="submit">Solicitar nuevo en lace</v-btn>
        </form>
    </v-card-text>
</v-card>
@endsection