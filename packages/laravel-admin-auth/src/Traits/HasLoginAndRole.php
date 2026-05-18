<?php

namespace De\AdminAuth\Traits;

trait HasLoginAndRole
{
    public function getAuthIdentifierName(): string
    {
        return 'login';
    }

    public function isBlocked(): bool
    {
        return (bool) $this->is_blocked;
    }

    public function isAdministrator(): bool
    {
        return $this->role === 'administrator';
    }

    public function roleLabel(): string
    {
        return match ($this->role) {
            'administrator' => 'Администратор',
            default => 'Пользователь',
        };
    }
}
