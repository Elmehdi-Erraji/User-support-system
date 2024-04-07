<?php

namespace App\Repositories\Contracts;

interface ActivityLogInterface
{
    public function all();

    public function paginate($perPage);

    public function findById($id);

    public function delete($id);

    public function searchLogs($searchQuery, $event);
}
