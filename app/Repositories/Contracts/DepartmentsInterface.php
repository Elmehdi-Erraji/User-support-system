<?php

namespace App\Repositories\Contracts;

interface DepartmentsInterface
{
    public function allWithPaginate($perPage);

    public function findById($id);

    public function findTrashedById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function restore($id);

    public function forceDelete($id);

    public function searchDepartments($searchQuery);
}
