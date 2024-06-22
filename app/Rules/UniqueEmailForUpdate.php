<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class UniqueEmailForUpdate implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        // Check if the email is unique except for the current user's email
        return User::where('email', $value)
                   ->where('id', '!=', $this->userId)
                   ->doesntExist();
    }

    public function message()
    {
        return 'The email has already been taken.';
    }
}
