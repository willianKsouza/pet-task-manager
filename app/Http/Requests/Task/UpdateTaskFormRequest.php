<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'due_date' => ['sometimes', 'date', 'after_or_equal:today'],
            'status' => ['sometimes', 'in:to_do,in_progress,in_review,done'],
            'priority' => ['sometimes', 'in:low,medium,high'],
            'user_id' => ['sometimes', 'exists:users,id'],
        ];
    }
}
