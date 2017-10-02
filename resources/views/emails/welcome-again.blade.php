@component('mail::message')

Thanks for registering with us!

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
Visit Site
@endcomponent

@component('mail::panel', ['url' => ''])
Some Inspirational Quote here.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
