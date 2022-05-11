<?php
namespace App\Http\Reques;
 
use Illuminate\Foundation\Http\FormRequest; 

class MembersRequest extends FormRequest
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
        $id=$this->segment(3);
        return 
                [  
                    "category"      =>  "required|numeric",  
                    "shop_name"     =>  "required|max:255", 
                    "name"          =>  "required|max:255",  
                    'email'         =>   "required|max:255|unique:members,email,$id,id,deleted_at,NULL",
                    "mobile"        =>  "required|max:255",
                    "password"      =>  "required_without:HdnEdit|max:255",
                    "status"        =>  "required|numeric",
                    "plan_id"       =>  "required_without:HdnEdit|numeric",
                ];
		
    }
    public function messages()
    {
       return [ 
            "status.numeric"   => 'The status field is required..' 
        ];
    }    
}
