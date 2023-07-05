<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class GenerateInspirationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $tags = json_decode(file_get_contents("https://api.waifu.im/tags"))->versatile;
        return [
            "limit" => ["required", "integer", "gte:0", "lte:100"],
            "category" => ["required", "string", "in:" . implode(",", $tags)]
        ];
    }
}
