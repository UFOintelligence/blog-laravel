@component('mail::message')
# Hola Brito Academy
{{ $data['name'] }} te ha enviado un mensaje desde la web Brito Academy.

@component('mail::panel')
{{ $data['message'] }}

@endcomponent
Correo de contacto: {{ $data['email'] }}
@endcomponent
