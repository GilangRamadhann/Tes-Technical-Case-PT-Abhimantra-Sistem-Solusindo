<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'nama'  => ['required','string','max:255'],
            'kelas' => ['required','string','max:10'],
        ];
    }
}
