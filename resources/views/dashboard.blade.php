<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                <p class="text-sm text-gray-500">Overview of trainers, roles, permissions, and time logs.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Trainers</p>
                    <p class="mt-2 text-3xl font-bold text-gray-800">{{ $totalTrainers }}</p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Active Trainers</p>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ $activeTrainers }}</p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Inactive Trainers</p>
                    <p class="mt-2 text-3xl font-bold text-red-600">{{ $inactiveTrainers }}</p>
                </div>

                <div class="rounded-2xl bg-gradient-to-r from-indigo-600 to-purple-600 p-5 text-white shadow-sm">
                    <p class="text-sm font-medium text-indigo-100">Total Worked Hours</p>
                    <p class="mt-2 text-3xl font-bold">{{ $totalWorkedHours }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Roles</p>
                    <p class="mt-2 text-3xl font-bold text-indigo-600">{{ $totalRoles }}</p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Permissions</p>
                    <p class="mt-2 text-3xl font-bold text-purple-600">{{ $totalPermissions }}</p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm font-medium text-gray-500">Time Logs</p>
                    <p class="mt-2 text-3xl font-bold text-blue-600">{{ $totalTimeLogs }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                    <div class="border-b border-gray-100 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Trainers</h3>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse ($recentTrainers as $trainer)
                            <div class="flex items-center justify-between px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $trainer->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $trainer->email }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-indigo-600">{{ $trainer->role->name ?? '-' }}</p>
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $trainer->status === 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $trainer->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-6 text-sm text-gray-500">No trainers found.</div>
                        @endforelse
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                    <div class="border-b border-gray-100 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Time Logs</h3>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse ($recentTimeLogs as $log)
                            <div class="flex items-center justify-between px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $log->trainer->name ?? '-' }}</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-indigo-600">
                                        {{ \Carbon\Carbon::parse($log->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($log->end_time)->format('h:i A') }}
                                    </p>
                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        {{ number_format($log->worked_hours, 2) }} hrs
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-6 text-sm text-gray-500">No time logs found.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>