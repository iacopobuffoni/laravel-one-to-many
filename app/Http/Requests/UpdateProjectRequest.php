<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Helpers
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
        return [
            'title' => [
                'required',
                Rule::unique('projects')->ignore($this->project->id),
                'max:128'
            ],
            'description' => 'required',
            'status' => [
                'required',
                Rule::in(['completed', 'active', 'on_hold', 'cancelled'])
            ],
            'image' => 'nullable|image|max:2048',
            'type_id' => 'nullable|exists:types,id'
        ];
    }
}