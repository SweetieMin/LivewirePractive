<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\LocationRepositoryInterface;
use App\Models\Location;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class LocationRepository implements LocationRepositoryInterface
{
    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return Location::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function create(array $data)
    {
        if (!isset($data['created_by'])) {
            $data['created_by'] = Auth::id();
        }
        //Tạo mới cơ sở
        return Location::create($data);
    }
}
