<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Task;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Bütün istifadəçilər yeniləyə bilər, yoxsa öz logic yaz
        return true;
        // return auth()->user()->can('update', $this->task);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'nullable|in:' . implode(',', [
                Task::STATUS_PENDING,
                Task::STATUS_IN_PROGRESS,
                Task::STATUS_COMPLETED
            ]),
            'due_date' => 'nullable|date',
        ];
    }

    /**
     * Optional: custom messages
     */
    public function messages(): array
    {
        return [
            'title.required' => ':attribute is required.',
            'project_id.required' => ':attribute is required.',
            'project_id.exists' => ':attribute does not exist.',
            'assigned_to.exists' => ':attribute does not exist.',
            'status.in' => 'Invalid :attribute selected.',
            'due_date.date' => ':attribute must be a valid date.',
        ];
    }
    /**
     * Optional: custom attributes
     */
    public function attributes(): array
    {
        return [
            'title' => 'Task Title',
            'description' => 'Task Description',
            'project_id' => 'Project',
            'assigned_to' => 'Assigned User',
            'status' => 'Task Status',
            'due_date' => 'Due Date',
        ];
    }
}