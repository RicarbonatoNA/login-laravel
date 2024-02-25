<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class recaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

    }

    public function passes($attribute, $value){
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => '6Lc5JGApAAAAAOKav3duJTOCqTaW_rZunXtb5ZqS',
            'response' => $value,
        ])->object();
        if($response->success && $response->score >= 0.7){
            return true;
        } else {
            return false;
        }
    }

    public function message() {
        return 'la verificacion de ReCaptcha ha fallado';
    }
}
