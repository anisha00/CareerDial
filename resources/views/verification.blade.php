
@component('mail::message')
    <h1>Greetings </h1>
    <p>Please click on the button to verify</p>
    @component('mail::button', ['url' => url('/verify/'.$user->verification_token)])
        Verify Email Address
    @endcomponent
@endcomponent
