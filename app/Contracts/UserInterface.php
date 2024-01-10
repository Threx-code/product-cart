<?php

namespace App\Contracts;

interface UserInterface
{
    public function getAllUsers();
    public function getSingleUser(int $userId);
}
