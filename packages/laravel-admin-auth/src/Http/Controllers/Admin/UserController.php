<?php

namespace De\AdminAuth\Http\Controllers\Admin;

use De\AdminAuth\Http\Requests\Admin\StoreUserRequest;
use De\AdminAuth\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @return class-string<Model>
     */
    protected function userModel(): string
    {
        return (string) config('auth.providers.users.model');
    }

    public function index(): View
    {
        $users = $this->userModel()::query()
            ->orderBy('name')
            ->paginate(15);

        return view('admin-auth::admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin-auth::admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userModel()::query()->create([
            ...$request->validated(),
            'password' => Hash::make($request->string('password')->value()),
            'is_blocked' => false,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Пользователь создан.');
    }

    public function edit(int $user): View
    {
        $user = $this->userModel()::query()->findOrFail($user);

        return view('admin-auth::admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $user): RedirectResponse
    {
        $user = $this->userModel()::query()->findOrFail($user);

        $data = $request->validated();

        if (isset($data['password']) && $data['password'] !== '') {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Данные пользователя обновлены.');
    }
}
