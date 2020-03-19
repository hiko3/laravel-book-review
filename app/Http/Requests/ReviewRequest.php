<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|max:255',
            'body'          => 'required',
            'image'         => 'mimes:jpeg,png,gif,svg|max:2048',
            'url'           => 'url'
        ];
    }

    public function reviewSaveData()
    {
        $inputs = $this->all();
        if ($this->hasFile('image')) {
            $this->file('image')->store('/public/images');
            $data = [
                'user_id'   => Auth::id(),
                'title'     => $inputs['title'],
                'body'      => $inputs['body'],
                'image'     => $this->file('image')->hashName(),
                'url'       => $inputs['url'],
            ];
        } else {
            $data = [
                'user_id'   => Auth::id(),
                'title'     => $inputs['title'],
                'body'      => $inputs['body'],
                'url'       => $inputs['url']
            ];
        }
        return $data;
    }

}
