<?php

namespace App\Repositories\Contracts;

interface UsersInterface
{
    public function getAllUsers();

    public function getUsersByRole(string $roleName);

    public function getUserById(string $id);

    public function createUser(array $data);

    public function updateUser(string $id, array $data);

    public function deleteUser(string $id);

    public function restoreUser(string $id);

    public function forceDeleteUser(string $id);

    public function getClients();
}
