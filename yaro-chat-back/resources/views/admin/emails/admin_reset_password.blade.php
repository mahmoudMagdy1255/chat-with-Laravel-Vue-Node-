@component('mail::message')

@component('mail::button', ['url' => aurl( 'reset/password/' . $data['token'] )])
Click Here To Reset Your Password Of {{ $data['admin']->email }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
