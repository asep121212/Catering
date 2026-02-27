<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        @if($user->role === 'merchant')

        <hr class="my-6">

        <h3 class="text-md font-semibold text-gray-800">
            Merchant Information
        </h3>

        <div>
            <x-input-label for="store_name" value="Store Name" />
            <x-text-input id="store_name" name="store_name" type="text" class="mt-1 block w-full"
                :value="old('store_name', optional($user->merchantProfile)->store_name)" />
        </div>

        <div>
            <x-input-label for="phone" value="Phone" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                :value="old('phone', optional($user->merchantProfile)->phone)" />
        </div>

        <div>
            <x-input-label for="address" value="Address" />
            <textarea name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    {{ old('address', optional($user->merchantProfile)->address) }}
                </textarea>
        </div>

        <div>
            <x-input-label for="description" value="Description" />
            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    {{ old('description', optional($user->merchantProfile)->description) }}
                </textarea>
        </div>

        <div>
            <x-input-label for="logo" value="Store Logo" />
            <input type="file" name="logo" class="mt-1 block w-full">
        </div>

        @if(optional($user->merchantProfile)->logo)
        <div>
            <img src="{{ asset('storage/' . $user->merchantProfile->logo) }}" class="w-24 mt-2 rounded">
        </div>
        @endif

        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p class="text-sm text-green-600">Saved.</p>
            @endif
        </div>
    </form>
</section>