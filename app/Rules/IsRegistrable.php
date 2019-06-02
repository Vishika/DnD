<?php

namespace App\Rules;

use App\Registrable;
use Illuminate\Contracts\Validation\Rule;

class IsRegistrable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $registrables = Registrable::all('discord_name');
        foreach ($registrables as $registrable) {
            if ($registrable->discord_name === $value) {
                Registrable::where('discord_name', $value)->delete();
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.is_registrable');
    }
}
