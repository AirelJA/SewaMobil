<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Daftar Mobil') }}
        </h2>
    </x-slot>

    <div class="sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white dark:bg-gray-800 sm:shadow-sm sm:rounded-lg">
                <div class="px-6 pt-6 mb-5 md:w-1/2 2xl:w-1/3">
                    @if (request('search'))
                    <h2 class="pb-3 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Search results for : {{ request('search') }}
                    </h2>
                    @endif
                    <form class="flex items-center gap-2">
                        <x-text-input id="search" name="search" type="text" class="w-full"
                            placeholder="Search by name or brand ..." value="{{ request('search') }}" autofocus/>
                        <x-primary-button type="submit">
                            {{ __('Search') }}
                        </x-primary-button>
                    </form>
                </div>
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('car.create') }}" />
                        </div>
                        <div>
                            @if (session('success'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                                </p>
                            @endif
                            @if (session('danger'))
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                                    class="text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Mobil
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Brand
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipe Mobil
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Plat Nomor
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Harga Sewa
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 ">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cars as $car)
                                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $car->name }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $car->brand }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $car->type }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $car->license }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $car->price }}
                                    </td>

                                    <td scope="row" class="px-6 py-4 font-medium
                                        @if ($car->ready)
                                            text-green-500 dark:text-green-500
                                        @else
                                            text-blue-500 dark:text-blue-500
                                        @endif
                                        dark:text-white">
                                        @if ($car->ready)
                                            Ready
                                        @else
                                            Not Ready
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                                <form action="{{ route('car.destroy', $car) }}" method="Post">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="text-green-600 dark:text-green-400">
                                                        <a href="{{ route('car.edit', $car) }}">
                                                            Edit
                                                        </a>
                                                    </button>
                                                    <form action="{{ route('car.destroy', $car) }}" method="Post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 dark:text-red-400" style="padding-left: 10px">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
