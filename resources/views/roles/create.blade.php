<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Add Role
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Role Name</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Enter role name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-3 block text-sm font-medium text-gray-700">Assign Permissions</label>
                        <div class="grid grid-cols-1 gap-3 rounded-2xl border border-gray-200 bg-gray-50 p-4 md:grid-cols-2">
                            @forelse ($permissions as $permission)
                                <label class="flex items-center gap-3 rounded-xl bg-white px-4 py-3 shadow-sm">
                                    <input type="checkbox"
                                           name="permissions[]"
                                           value="{{ $permission->id }}"
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                           {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                    <span class="text-sm font-medium text-gray-700">{{ $permission->name }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-gray-500">No permissions available.</p>
                            @endforelse
                        </div>
                        @error('permissions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('roles.index') }}"
                           class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex items-center rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:from-indigo-700 hover:to-purple-700">
                            Save Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>