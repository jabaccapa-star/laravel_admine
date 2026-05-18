<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Рабочий стол
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-medium">Добро пожаловать, {{ Auth::user()->name }}!</p>
                    <p class="mt-2 text-sm text-gray-600">
                        Роль: <span class="font-semibold">{{ Auth::user()->roleLabel() }}</span>
                    </p>
                </div>
            </div>

            @if (Auth::user()->isAdministrator())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Администрирование</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Добавление новых пользователей, изменение данных и снятие блокировки.
                        </p>
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Управление пользователями
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>



