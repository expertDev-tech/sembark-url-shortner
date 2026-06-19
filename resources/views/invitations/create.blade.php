<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Send Invitation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('invitations.store') }}">
                    @csrf

                    @role('SuperAdmin')
                        <div class="mb-4">
                            <label class="block mb-2">
                                Company Name
                            </label>

                            <input
                                type="text"
                                name="company_name"
                                value="{{ old('company_name') }}"
                                class="w-full border rounded"
                            >

                            @error('company_name')
                                <p class="text-red-500 text-sm">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @endrole

                    <div class="mb-4">
                        <label class="block mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full border rounded"
                        >

                        @error('email')
                            <p class="text-red-500 text-sm">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    @role('Admin')
                        <div class="mb-4">
                            <label class="block mb-2">
                                Role
                            </label>

                            <select
                                name="role"
                                class="w-full border rounded"
                            >
                                <option value="Admin">
                                    Admin
                                </option>

                                <option value="Member">
                                    Member
                                </option>
                            </select>

                            @error('role')
                                <p class="text-red-500 text-sm">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    @endrole

                    <x-primary-button>
                        Send Invitation
                    </x-primary-button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>