<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Permission
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <form action="{{ route('permissions.update', $permission) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Permission Name</label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $permission->name) }}"
                               placeholder="e.g. create_trainer"
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="rounded-2xl border border-yellow-100 bg-yellow-50 p-4">
                        <p class="text-sm font-semibold text-yellow-700">Important</p>
                        <p class="mt-1 text-sm text-yellow-600">
                            Updating this permission may affect roles already using it.
                        </p>
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('permissions.index') }}"
                           class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex items-center rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md transition hover:from-indigo-700 hover:to-purple-700">
                            Update Permission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>