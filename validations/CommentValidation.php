<?php

namespace App\Validations;

use Illuminate\Validation\Factory;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use App\Utils\DB;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Database\Capsule\Manager as Capsule;

class CommentValidation
{
    private Factory $validator;

    public function __construct()
    {
        $translator = new Translator(new ArrayLoader(), 'en');
        $validator = new Factory($translator);
        $db = new DB;

        $presenceVerifier = new DatabasePresenceVerifier($db->getDBManager());
        $validator->setPresenceVerifier($presenceVerifier);

        $this->validator = $validator;
    }

    public function validate(array $data)
    {
        $rules = [
            'news_id' => 'required|numeric|exists:news,id',
            'body' => 'required|string|max:225'
        ];

        $validation = $this->validator->make($data, $rules);

        if ($validation->fails()) {
            throw new \Exception($validation->errors()->first());
        }
    }
}
