<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Пользователи
            </h2>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Добавить
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                            <tr class="text-left text-gray-600">
                                <th class="py-2 pe-4">Имя</th>
                                <th class="py-2 pe-4">Логин</th>
                                <th class="py-2 pe-4">Email</th>
                                <th class="py-2 pe-4">Роль</th>
                                <th class="py-2 pe-4">Статус</th>
                                <th class="py-2"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="py-3 pe-4">{{ $user->name }}</td>
                                    <td class="py-3 pe-4">{{ $user->login }}</td>
                                    <td class="py-3 pe-4">{{ $user->email }}</td>
                                    <td class="py-3 pe-4">{{ $user->roleLabel() }}</td>
                                    <td class="py-3 pe-4">
                                        @if ($user->isBlocked())
                                            <span class="text-red-600 font-medium">Заблокирован</span>
                                        @else
                                            <span class="text-green-600">Активен</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:underline">
                                            Изменить
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
