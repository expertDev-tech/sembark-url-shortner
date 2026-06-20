<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Short URLs
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    Short Code
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Original URL
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Hits
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Created By
                                </th>

                                <th class="px-4 py-3 text-left">
                                    Company
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($shortUrls as $shortUrl)

                                <tr class="border-t">

                                    <td class="px-4 py-3">
                                        <a
                                            href="{{ route('short-urls.redirect', $shortUrl->short_code) }}"
                                            target="_blank"
                                            class="text-blue-600"
                                        >
                                            {{ route('short-urls.redirect', $shortUrl->short_code) }}
                                        </a>
                                    </td>

                                    <td class="px-4 py-3">
                                        <a
                                            href="{{ $shortUrl->original_url }}"
                                            target="_blank"
                                            class="text-blue-600"
                                        >
                                            {{ Str::limit($shortUrl->original_url, 50) }}
                                        </a>
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $shortUrl->hits }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $shortUrl->user->name }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $shortUrl->company->name }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="5"
                                        class="px-4 py-6 text-center"
                                    >
                                        No short URLs found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">
                    {{ $shortUrls->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>