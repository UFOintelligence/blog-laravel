@component('mail::message')
# Hola {{ $author->name }}
{{ $question->user->name }} te ha enviado un comentario desde la web Brito Academy.

@component('mail::panel')
{{ $question->body }}

@endcomponent
Correo de contacto: {{ $question->user->email }}
@endcomponent
