<?php

namespace App\Repositories\Contracts;

interface FaqInterface
{
    public function all();

    public function paginate($perPage);

    public function findById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function searchFaqs($searchQuery, $category, $status);
}
