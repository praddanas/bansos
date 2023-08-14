<?php

namespace App\Entities;

use App\Models\User as ModelsUser;
use CodeIgniter\Entity\Entity;

class User extends BaseEntity
{
    protected $modelName = ModelsUser::class;
    protected $datamap = [
        'id' => 'user_id'
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
