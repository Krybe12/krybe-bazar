@component('mail::message')
oy {{ $seller }},

 {{ $message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
