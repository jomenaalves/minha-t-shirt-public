<?php

namespace App\Http\Requests\Cashier;

use Illuminate\Foundation\Http\FormRequest;

class AddProductsRequest extends FormRequest
{
    public function rules()
    {
        $rules = [];

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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
           
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

        ];
    }

}
