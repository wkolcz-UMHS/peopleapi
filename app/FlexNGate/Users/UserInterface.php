<?php

namespace App\FlexNGate\Users;

interface UserInterface{
    public function authenicate($user);
    public function create($user);
}
