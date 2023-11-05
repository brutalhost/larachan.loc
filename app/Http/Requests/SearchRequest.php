<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class SearchRequest extends FormRequest
{
    public $urlSearchKey = 'search';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            $this->urlSearchKey => 'nullable|string',
        ];
    }

    public function getSearchString() : string
    {
        $data = $this->validate($this->rules());
        return $data[$this->urlSearchKey] ?? '';
    }
}
