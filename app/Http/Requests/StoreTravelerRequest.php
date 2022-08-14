<?php

namespace App\Http\Requests;

use App\Models\Traveler;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTravelerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('traveler_create');
    }

    public function rules()
    {
        return [
            'booking_id' => [
                'required',
                'integer',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'gender' => [
                'required',
            ],
        ];
    }
}