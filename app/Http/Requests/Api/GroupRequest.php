<?php

/**
 * Created by PhpStorm.
 * User: nikita.kem
 * Date: 2/28/17
 * Time: 7:38 PM
 */

namespace App\Http\Requests\Api;

use App\Group;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        return Group::rules();
    }
}
