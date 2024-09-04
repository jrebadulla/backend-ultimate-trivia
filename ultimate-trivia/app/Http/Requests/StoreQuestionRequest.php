<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change to true to allow all users to make this request
        // You can add your own logic if you need specific authorization
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
            'game_id' => 'required|string',
            'level_id' => 'required|string',
            'question_text' => 'required|string|max:255',
            'correct_answer' => 'required|string|max:255',
            'option_a' => 'nullable|string|max:255',
            'option_b' => 'nullable|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'image1' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'image3' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'image4' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}

