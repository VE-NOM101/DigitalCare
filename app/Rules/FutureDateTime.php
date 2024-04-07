<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class FutureDateTime implements Rule
{
    public function passes($attribute, $value)
    {
        // Convert preferred date and time to Carbon instance
        $preferredDateTime = Carbon::createFromFormat('Y-m-d H:i', $value);

        // Calculate current time plus 12 hours
        $futureDateTime = Carbon::now()->addHours(24);

        // Check if preferred date and time is at least 12 hours in the future
        return $preferredDateTime->gt($futureDateTime);
    }

    public function message()
    {
        return 'The :attribute must be at least 24 hours in the future.';
    }
}
