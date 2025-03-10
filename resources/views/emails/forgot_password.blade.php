@component('mail::message')

Hello {{ $user->name }},

<p>We understand it happens.</p>

<p>
    @component('mail::button', ['url' => url('reset/'.$user->remember_token)])
    Reset Your Password
    @endcomponent
</p>

<p>In case your have any issues recovering your password, please contact us.</p>
@php
    $getSetting = App\Models\SystemSettingModel::getSingle();
@endphp

Thanks,<br>
{{ $getSetting->website_name }}

@endcomponent
