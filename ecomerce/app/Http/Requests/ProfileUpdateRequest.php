<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstname' => [
                'required',
                'string',
                'max:255',
            ],

            'lastname' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)
                    ->ignore($this->user()->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
        ];
    }
}