<?php

namespace App\Http\Requests\Cashier;

use Illuminate\Foundation\Http\FormRequest;

class CashierRequest extends FormRequest
{
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        $rules = [
            'date_accounting' => 'bail|required|date',
            'note' => 'bail|required|string',
            'products_total' => 'bail|required|numeric',
        ];

        // Check if at least one product field exists
        if (!$this->hasAnyProductField()) {
            $rules['product_exists'] = 'bail|required';
        }

        // Get unique indices for product fields
        $productIndices = $this->getUniqueProductIndices();

        // Loop through each product index and add validation rules
        foreach ($productIndices as $index) {
            if ($this->has("product-$index") || $this->has("stock-$index") || $this->has("quantity-$index") || $this->has("price-$index")) {
                $rules["product-$index"] = "bail|required|numeric";
                $rules["stock-$index"] = "bail|required|numeric";
                $rules["quantity-$index"] = "bail|required|numeric";
                $rules["price-$index"] = "bail|required|numeric";
            }
        }

        // Check if at least one method field exists
        if (!$this->hasAnyMethodField()) {
            $rules['method_exists'] = 'bail|required';
        }

         // Get unique indices for payments fields
        $methodsIndices = $this->getUniqueMethodsIndices();

        // Loop through each method field and add validation rules
        foreach ($methodsIndices as $index) {
            if ($this->has("value-$index")) {
                $rules["methods-$index"] = "bail|required|string";
                $rules["value-$index"] = "bail|required|numeric";
            }
        }

        return $rules;
    }

    /**
     * Check if any product field exists in the request.
     *
     * @return bool
     */
    private function hasAnyProductField()
    {
        foreach ($this->all() as $key => $value) {
            if (strpos($key, 'product-') === 0) {
                return true;
            }
        }
        return false;
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

    /**
     * Get unique indices for product fields.
     *
     * @return array
     */
    private function getUniqueProductIndices()
    {
        $indices = [];
        foreach ($this->all() as $key => $value) {
            if (preg_match('/^product-(\d+)$/', $key, $matches) || preg_match('/^stock-(\d+)$/', $key, $matches) || preg_match('/^quantity-(\d+)$/', $key, $matches) || preg_match('/^price-(\d+)$/', $key, $matches)) {
                $indices[$matches[1]] = $matches[1];
            }
        }
        return array_values($indices);
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
            'date_accounting.required' => 'A data contábil é obrigatória.',
            'date_accounting.date' => 'A data contábil deve estar em um formato de data válido.',
            'note.required' => 'A nota é obrigatória.',
            'note.string' => 'A nota deve ser uma string.',
            'products-total.required' => 'Deve ser informado o valor total dos produtos',
            'products-total.numeric' => 'O valor final dos produtos deve ser um valor numérico.',

            // Custom message for at least one product field
            'product_exists.required' => 'Deve ser inserido ao menos 1 produto.',

            // Messages for product fields
            'product-*.required' => 'O campo de produto é obrigatório.',
            'product-*.numeric' => 'O campo de produto deve ser numérico.',
            'stock-*.required' => 'O campo de estoque é obrigatório.',
            'stock-*.numeric' => 'O campo de estoque deve ser numérico.',
            'quantity-*.required' => 'O campo de quantidade é obrigatório.',
            'quantity-*.numeric' => 'O campo de quantidade deve ser numérico.',
            'price-*.required' => 'O campo de preço é obrigatório.',
            'price-*.numeric' => 'O campo de preço deve ser numérico.',

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

