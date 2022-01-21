<?php

namespace Bsdev\Shipping\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingRequest extends FormRequest
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
            'shipping_param' => 'required|in:' . implode(',', \Bsdev\Shipping\Models\Shipping::SHIPPING_PARAM),
            'shipping_param_min' => 'required|numeric|min:0',
            'shipping_param_max' => 'required|numeric|min:0',
            'time_param' => 'required|in:' . implode(',', \Bsdev\Shipping\Models\Shipping::TIME_PARAM),
            'time_param_min' => 'required|numeric|min:1',
            'time_param_max' => 'required|numeric|min:1',
            'cost' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => 'nullable|in:1',
            'clusters' => 'required',
            'clusters.*' => 'exists:clusters,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ];
    }
}
