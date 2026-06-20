<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Create Short URL
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form
                    method="POST"
                    action="{{ route('short-urls.store') }}"
                >
                    @csrf

                    <div>
                        <x-input-label
                            for="original_url"
                            value="Original URL"
                        />

                        <x-text-input
                            id="original_url"
                            name="original_url"
                            type="url"
                            class="block mt-1 w-full"
                            :value="old('original_url')"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('original_url')"
                            class="mt-2"
                        />
                    </div>

                    <div class="mt-4">
                        <x-primary-button>
                            Create Short URL
                        </x-primary-button>
                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>