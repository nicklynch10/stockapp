<x-guest-layout>
    <x-jet-authentication-card style="background-image: url('/images/blue-rounded.png');background-size: cover">

        <x-slot name="logo">

        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="flex justify-center my-2 text-xl font-bold">
                <x-jet-authentication-card-logo />
            </div>
            <div class="mt-4">
                <label for="first_name" class="block font-medium text-gray-700">{{ __('First Name') }} <span class="text-red-700 font-bold">*</span></label>
                <x-jet-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autocomplete="first-name" placeholder="Enter First Name"/>
            </div>

            <div class="mt-4">
                <label for="last_name" class="block font-medium text-gray-700">{{ __('Last Name') }} <span class="text-red-700 font-bold">*</span></label>
                <x-jet-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last-name" placeholder="Enter Last Name"/>
            </div>

            <div class="mt-4">
                <label for="email" class="block font-medium text-gray-700">{{ __('Email') }} <span class="text-red-700 font-bold">*</span></label>
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="Enter Email" />
            </div>

            <div class="mt-4">
                <label for="password" class="block font-medium text-gray-700">{{ __('Password') }} <span class="text-red-700 font-bold">*</span></label>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Enter Password"/>
            </div>

            <div class="mt-4">
                <label for="password_confirmation" class="block font-medium text-gray-700">{{ __('Confirm Password') }} <span class="text-red-700 font-bold">*</span></label>
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Enter Confirm Password"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
