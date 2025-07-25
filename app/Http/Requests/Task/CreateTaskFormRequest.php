<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskFormRequest extends FormRequest
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
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'due_date' => ['required', 'date', 'after_or_equal:today'],
                'user_id' => ['required', 'exists:users,id'],
                'priority' => ['required', 'in:low,medium,high'],
                'status' => ['required', 'in:to_do,in_progress,in_review,done'],
        ];
    }
}
