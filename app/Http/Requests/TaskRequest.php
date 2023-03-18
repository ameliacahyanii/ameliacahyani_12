<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rule_task_unique = Rule::unique('task', 'task'); // Mendeklarasikan variable 
        if ($this->method() !== 'POST'){ // Logic: Jika data yang kita masukkan menggunakan POST, maka Rule:unique berlaku
            $rule_task_unique->ignore($this->route()->parameter('id')); // Logic: Jika tidak menggunakan POST, maka variblenya di ignore
        };

        return [
            'task' => ['required', $rule_task_unique],
            'user' => ['required']
        ];
    }

    public function messages(){
        return[
            'required' => 'isian :atrribute harus di isi',// Cara 1: Jika mau default
            'user.required' => 'nama pengguna harus di isi' // Cara 2: Dapat dibedakan salah satunya
        ];
    }
}
