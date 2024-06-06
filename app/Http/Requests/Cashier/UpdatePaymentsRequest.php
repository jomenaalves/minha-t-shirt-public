<?php

namespace App\Http\Requests\Cashier;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentsRequest extends FormRequest
{
     /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        $rules = [
            'cashier_id' => 'bail|required|numeric'
        ];

        // Check if at least one method field exists
        if (!$this->hasAnyMethodField()) {
            $rules['method_exists'] = 'bail|required';
        }

         // Get unique indices for payments fields
        $methodsIndices = $this->getUniqueMethodsIndices();

        // Loop through each method field and add validation rules
        foreach ($methodsIndices as $index) {
            if ($this->has("methods-$index") || $this->has("value-$index")) {
                $rules["methods-$index"] = "bail|required|string";
                $rules["value-$index"] = "bail|required|numeric";
            }
        }

        return $rules;
    }

    /**
     * Check if any method field exists in the request.
     *
     * @return bool
     */
    private function hasAnyMethodField()
    {
        foreach ($this->all() as $key => $value) {
            if (strpos($key, 'methods-') === 0) {
                return true;
            }
        }
        return false;
    }

    private function getUniqueMethodsIndices()
    {
        $indices = [];
        foreach ($this->all() as $key => $value) {
            if (preg_match('/^methods-(\d+)$/', $key, $matches) || preg_match('/^value-(\d+)$/', $key, $matches)) {
                $indices[$matches[1]] = $matches[1];
            }
        }
        return array_values($indices);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cashier_id.required' => 'O Id do caixa é obrigatória.',
            'cashier_id.date' => 'O Id do caixa deve ser numérico.',
           
            // Custom message for at least one method field
            'method_exists.required' => 'Deve ser inserido ao menos 1 método de pagamento.',

            // Messages for method fields
            'methods-*.required' => 'O campo de método de pagamento é obrigatório.',
            'methods-*.string' => 'O campo de método de pagamento deve ser um texto.',
            'value-*.required' => 'O campo de valor é obrigatório.',
            'value-*.numeric' => 'O campo de valor deve ser numérico.',
        ];
    }
}
