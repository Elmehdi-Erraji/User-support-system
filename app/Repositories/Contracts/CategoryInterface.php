<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryInterface {
    public function allWithPaginate(int $perPage = 10): LengthAwarePaginator;
    public function getAllDepartments(): Collection;
    public function findById(int $id);
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function delete(int $id);
    public function searchCategories(string $searchQuery = null, $departmentId = null): Collection;
}