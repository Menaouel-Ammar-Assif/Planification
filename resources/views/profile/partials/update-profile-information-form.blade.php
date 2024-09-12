<section>
    <header>
        <h2 class="text-gray-900 fs-3 font-weight-bold">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-2">
            <x-input-label for="name" :value="__('Nom et Prénom :')" style="margin-right: 106px"/>
            <x-text-input id="name" name="name" type="text" class="block p-1 mt-1 block w-full p-1" style="border-radius: 5px" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- <div class="mb-2 mt-2 ">
            <x-input-label for="phone" :value="__('Prénom :')" class="mr-3" style="margin-right: 206px" />
            <x-text-input id="phone" name="phone" type="text" class="block p-1" style="border-radius: 5px" :value="old('phone', $user->lname)" required autofocus autocomplete="lname" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div> --}}

        <div class="mb-3">
            <x-input-label for="email" :value="__('Username :')"  style="margin-right: 110px;" />
            <x-text-input id="email" name="email" type="email" class="block p-1 mt-1 block w-full p-1" style="border-radius: 5px" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse e-mail n-est pas vérifiée.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cliquez ici pour renvoyer le (email) de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-3 btn">
            <x-primary-button style="background-color: rgb(82, 77, 233)!important;">{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
