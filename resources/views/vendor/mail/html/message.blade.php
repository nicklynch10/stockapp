@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', [
    'url' => config('app.url'),
    'appLogo' => $appLogo ?? appLogo(),
    'appName' => $appName ?? appName(),
])
{{ $appName ?? appName() }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
345 Harrison Avenue, Boston, MA 02118

@if(isset($manageMailPreferenceLink) && isset($unsubscribeLink))
<a href="{{ $unsubscribeLink }}" target="_blank">Unsubscribe</a> | <a href="{{ $manageMailPreferenceLink }}" target="_blank">Manage Mail Preferences</a>
@endif

© {{ date('Y') }} {{ appName(true) }} <img style="height: .75rem;" src="{{ appFavicon(true) }}"> @lang('All rights reserved.')

@endcomponent
@endslot
@endcomponent
