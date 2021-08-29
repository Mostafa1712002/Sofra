
@component('mail::message')
<p>{{ $client->name }} أهلا عملينا العزيز </p>
<p>
    رمز استعادة كلمة المرور هو
    <h1>{{ $client->pin_code }}</h1>

</p>
شكرا ,<br>
{{ config('app.name') }}
@endcomponent
