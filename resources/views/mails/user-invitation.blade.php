@component('mail::message', [
    'appLogo' => $appLogo ?? null,
    'appName' => $appName ?? null,
])
    # Hello!

    {{$sender}} has invited you to join {{ $appName }}.

    {{ $appName }} enables users to easily tax loss harvest within all accounts

    @component('mail::button', ['url' => route('register')])
        Sign up!
    @endcomponent

    Thank you for using {{ $appName }}.

    Regards,<br>
    {{ $appName }} Team


@endcomponent

