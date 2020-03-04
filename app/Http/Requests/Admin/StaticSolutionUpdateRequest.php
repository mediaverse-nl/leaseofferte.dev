<?php

namespace App\Http\Requests\Admin;

use App\LeaseOffer;
use Illuminate\Foundation\Http\FormRequest;

class StaticSolutionUpdateRequest extends FormRequest
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
        $rules = [
            'images' => 'required',
            'title' => 'required|min:3|max:70',
            'description' => 'required',
            'uitvoering' => 'required',
            'merk' => 'required',
            'type' => 'required',
            'kleur' => 'required',
            'number_of_doors' => 'required|in:'.implode(',',LeaseOffer::amountOfDoors()),
            'auto_segment' => 'required|in:'.implode(',',LeaseOffer::segment()),
            'carrosserie' => 'required|in:'.implode(',',LeaseOffer::carrosserie()),
            'fuel' => 'required|in:'.implode(',',LeaseOffer::fuels()),
            'catalogusprijs' => 'required|numeric',
            'bijtelling' => 'required|numeric',
            'inbegrepen' => 'nullable',
            'meta_title' => 'nullable|max:80',
            'meta_description' => 'nullable|max:170',
        ];
        foreach($this->request->get('lease_conditions') as $key => $val){
            $rules['lease_conditions.'.$key.'.km_per_jaar'] = 'required|numeric';
            $rules['lease_conditions.'.$key.'.leaseprijs_per_maand'] = 'required|numeric';
            $rules['lease_conditions.'.$key.'.looptijd'] = 'required|in:12,18,24,30,36,42,48,54,60,72,84';
        }
        foreach($this->request->get('kleur') as $key => $val){
            $rules['kleur.'.$key] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'lease_conditions.*.km_per_jaar.required' => 'km per jaar is verplicht.',
            'lease_conditions.*.km_per_jaar.numeric' => 'km per jaar moet een nummer zijn.',
            'lease_conditions.*.leaseprijs_per_maand.required' => 'leaseprijs p.m. is verplicht.',
            'lease_conditions.*.leaseprijs_per_maand.numeric' => 'leaseprijs p.m. moet een nummer zijn.',
            'lease_conditions.*.looptijd.required' => 'looptijd is verplicht.',
            'kleur.*.required' => 'kleur is verplicht.',
        ];
    }
}
