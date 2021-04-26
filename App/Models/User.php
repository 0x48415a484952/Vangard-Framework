<?php

declare(strict_types=1);

namespace Septillion\App\Models;

use Septillion\Framework\Model\Model;

class User extends Model
{
    public function getUsers()
    {
        return $this->getConnection()->query('select * from users')->fetch();
    }
}