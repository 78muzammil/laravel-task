<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'profile_image' => $row['profile_image'] ?? null,
            'name' => $row['name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'street_address' => $row['street_address'] ?? null,
            'city' => $row['city'],
            'state' => $row['state'],
            'country' => $row['country'],
        ]);
    }
}
