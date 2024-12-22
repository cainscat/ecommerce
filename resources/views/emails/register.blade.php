@component('mail::message')

Hi <b>{{ $user->name }}</b>,
<p>You're almost ready to start enjoying the benefits of E-commerce</p>
<p>Simple click the button bellow to verify your email address.</p>
<p>
    @component('mail::button', ['url' => url('activate/'.base64_encode($user->id))])
    Verify
    @endcomponent
</p>

<p>This will verify your address and then you'll officially be a part of the E-commerce</p>

@endcomponent
