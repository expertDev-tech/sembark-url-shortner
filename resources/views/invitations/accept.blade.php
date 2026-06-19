<x-guest-layout>

    <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <h2 class="text-xl font-semibold mb-6 text-center">
            Accept Invitation
        </h2>

        <form
            method="POST"
            action="{{ route('invitations.accept.store', $invitation->token) }}"
        >
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" value="Email" />

                <x-text-input
                    id="email"
                    class="block mt-1 w-full bg-gray-100"
                    type="email"
                    :value="$invitation->email"
                    disabled
                />
            </div>

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" value="Name" />

                <x-text-input
                    id="name"
                    class="block mt-1 w-full"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" value="Password" />

                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <x-text-input
                    id="password_confirmation"
                    class="block mt-1 w-full"
                    type="password"
                    name="password_confirmation"
                    required
                />
            </div>

            <div class="flex justify-end">
                <x-primary-button>
                    Accept Invitation
                </x-primary-button>
            </div>

        </form>

    </div>

</x-guest-layout>