<?php

namespace App\Validations;

use Illuminate\Validation\Factory;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;

class NewsValidation
{
    private Factory $validator;

    public function __construct()
    {
        $translator = new Translator(new ArrayLoader(), 'en');
        $validator = new Factory($translator);
        $this->validator = $validator;
    }

    /**
     * Validate the provided data against the specified rules.
     *
     * @param array $data The data to be validated.
     * @throws \Exception If validation fails, an exception is thrown with the error messages.
     */
    public function validate(array $data)
    {
        $rules = [
            'title' => 'required|string|max:100',
            'body' => 'required|string|max:225'
        ];

        $validation = $this->validator->make($data, $rules);

        if ($validation->fails()) {
            throw new \Exception($validation->errors());
        }
    }
}
