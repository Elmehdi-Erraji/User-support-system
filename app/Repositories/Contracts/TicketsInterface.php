<?php

namespace App\Repositories\Contracts;

interface TicketsInterface
{
    public function all();

    public function paginate($perPage);

    public function findById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);

    public function restore($id);

    public function forceDelete($id);

    public function searchTickets($searchQuery, $priority, $status, $agent);
}
