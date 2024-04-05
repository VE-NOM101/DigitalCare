@component('mail::message')
    # Hi, {{ $user->name }}. Forgot your Password?

    It happens. Click the button below to reset your password.

    @component('mail::button', ['url' => url('/reset/'.$user->email.'/'. $user->remember_token), 'color' => 'success'])
        Reset Your Password
    @endcomponent

    In case you have any issues recovering your passcode, please contact us using the form from the contact-us page.

    Thanks,
    {{ config('app.name') }}
@endcomponent
