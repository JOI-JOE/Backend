<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkspaceRequest extends FormRequest
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
        $workspaceId = $this->route('workspaces');  // Lấy ID từ route (đảm bảo rằng tên tham số trong route là 'workspace')

        // Xử lý các validation rules chung cho cả store và update
        $rules = [
            'team_type_id' => ['nullable', 'exists:team_types,id'],
            'id_member_creator' => ['required', 'exists:users,id'],
            'desc' => ['nullable', 'string'],  // desc là tùy chọn
            'logo_hash' => ['nullable', 'string', 'max:255'],  // logo_hash là tùy chọn
            'logo_url' => ['nullable', 'string', 'max:255'],  // logo_url là tùy chọn
            'visibility' => ['required', 'in:private,public'],  // visibility là bắt buộc, chỉ có thể là 'private' hoặc 'public'
            'is_archived' => ['nullable', 'boolean'],  // is_archived là kiểu boolean và có thể null
        ];

        if ($this->isMethod('POST')) {
            $rules['name'] = ['required', 'string', 'max:255', 'unique:workspaces,name'];
            // $rules['display_name'] = ['required', 'string', 'max:255'];  // display_name là bắt buộc và tối đa 255 ký tự
        }

        if ($this->isMethod('PUT')) {
            $rules['name'] = [
                'required',
                'string',
                'max:255',
                'unique:workspaces,name,' . $this->id,  // Bỏ qua kiểm tra unique cho workspace hiện tại
            ];
        }

        return $rules;
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'team_type_id.required' => 'The team type is required.',
            'team_type_id.exists' => 'The selected team type is invalid.',
            'id_member_creator.required' => 'The member creator is required.',
            'id_member_creator.exists' => 'The selected member creator is invalid.',
            'display_name.required' => 'The display name is required.',
            'display_name.max' => 'The display name may not be greater than 255 characters.',
            'name.required' => 'The name is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
            'logo_hash.max' => 'The logo hash may not be greater than 255 characters.',
            'logo_url.max' => 'The logo URL may not be greater than 255 characters.',
            'visibility.required' => 'The visibility is required.',
            'visibility.in' => 'The selected visibility is invalid.',
            'is_archived.boolean' => 'The is archived field must be true or false.',
        ];
    }
}
