<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->user()->role === 'admin') {
            return true;
        }

        if ($this->isMethod('POST')) {
            return true;
        }

        $article = $this->route('article');
        return $article && $article->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    if ($this->user()->role !== 'admin') {
                        $query->where('user_id', $this->user()->id);
                    }
                }),
            ],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'gallery' => ['nullable', 'array', 'max:5'],
            'gallery.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ];
    }
}
