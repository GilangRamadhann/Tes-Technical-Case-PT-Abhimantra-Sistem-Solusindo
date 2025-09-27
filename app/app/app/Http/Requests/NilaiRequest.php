<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NilaiRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array {
        return [
            'siswa_id' => ['required','exists:siswas,id'],
            'kelas'    => ['required','string','max:10'],
            'mapel'    => ['required','string','max:50'],
            'nilai'    => ['required','integer','between:0,100'],
        ];
    }
}
