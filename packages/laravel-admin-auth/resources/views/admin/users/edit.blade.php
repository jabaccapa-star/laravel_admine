<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактирование: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" value="Имя" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name', $user->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="login" value="Логин" />
                        <x-text-input id="login" name="login" type="text" class="block mt-1 w-full" :value="old('login', $user->login)" required />
                        <x-input-error :messages="$errors->get('login')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Новый пароль (необязательно)" />
                        <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Подтверждение пароля" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full" />
                    </div>

                    <div>
                        <x-input-label for="role" value="Роль" />
                        <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="user" @selected(old('role', $user->role) === 'user')>Пользователь</option>
                            <option value="administrator" @selected(old('role', $user->role) === 'administrator')>Администратор</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2">
                            <input type="hidden" name="is_blocked" value="0">
                            <input type="checkbox" name="is_blocked" value="1" class="rounded border-gray-300"
                                   @checked(old('is_blocked', $user->is_blocked))>
                            <span class="text-sm text-gray-700">Заблокировать пользователя</span>
                        </label>
                        <x-input-error :messages="$errors->get('is_blocked')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Сохранить</x-primary-button>
                        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
