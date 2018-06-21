<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Campul :attribute trebuie sa fie acceptat.',
    'active_url' => 'Campul :attribute nu este un URL valid.',
    'after' => 'Campul :attribute trebuie sa fie o data dupa :date.',
    'after_or_equal' => 'Campul :attribute trebuie sa fie o data ulterioara sau egala cu :date.',
    'alpha' => 'Campul :attribute poate conține doar litere.',
    'alpha_dash' => 'Campul :attribute poate conține doar litere, numere si cratime.',
    'alpha_num' => 'Campul :attribute poate conține doar litere si numere.',
    'array' => 'Campul :attribute trebuie sa fie un array.',
    'before' => 'Campul :attribute trebuie sa fie o data inainte de :date.',
    'before_or_equal' => 'Campul :attribute trebuie sa fie o data inainte sau egala cu :date.',
    'between' => [
        'numeric' => 'Campul :attribute trebuie sa fie intre :min si :max.',
        'file' => 'Campul :attribute trebuie sa fie intre :min si :max kiloocteți.',
        'string' => 'Campul :attribute trebuie sa fie intre :min si :max caractere.',
        'array' => 'Campul :attribute trebuie sa aiba intre :min si :max elemente.',
    ],
    'boolean' => 'Campul :attribute trebuie sa fie adevarat sau fals.',
    'confirmed' => 'Confirmarea :attribute nu se potriveste.',
    'date' => 'Campul :attribute nu este o data valida.',
    'date_format' => 'Campul :attribute trebuie sa fie in formatul :format.',
    'different' => 'Campurile :attribute si :other trebuie sa fie diferite.',
    'digits' => 'Campul :attribute trebuie sa aiba :digits cifre.',
    'digits_between' => 'Campul :attribute trebuie sa aiba intre :min si :max cifre.',
    'dimensions' => 'Campul :attribute are dimensiuni de imagine nevalide.',
    'distinct' => 'Campul :attribute are o valoare duplicat.',
    'email' => 'Campul :attribute trebuie sa fie o adresa de e-mail valida.',
    'exists' => 'Campul :attribute selectat nu este valid.',
    'file' => 'Campul :attribute trebuie sa fie un fisier.',
    'filled' => 'Campul :attribute trebuie completat.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'Campul :attribute trebuie sa fie o imagine.',
    'in' => 'Campul :attribute selectat nu este valid.',
    'in_array' => 'Campul :attribute nu exista in :other.',
    'integer' => 'Campul :attribute trebuie sa fie un numar intreg.',
    'ip' => 'Campul :attribute trebuie sa fie o adresa IP valida.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'Campul :attribute trebuie sa fie un string JSON valid.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'Campul :attribute nu poate fi mai mare de :max.',
        'file' => 'Campul :attribute nu poate avea mai mult de :max kiloocteți.',
        'string' => 'Campul :attribute nu poate avea mai mult de :max caractere.',
        'array' => 'Campul :attribute nu poate avea mai mult de :max elemente.',
    ],
    'mimes' => 'Campul :attribute trebuie sa fie un fisier de tipul: :values.',
    'mimetypes' => 'Campul :attribute trebuie sa fie un fisier de tipul: :values.',
    'min' => [
        'numeric' => 'Campul :attribute nu poate fi mai mic de :min.',
        'file' => 'Campul :attribute trebuie sa aiba cel puțin :min kiloocteți.',
        'string' => 'Campul :attribute trebuie sa aiba cel puțin :min caractere.',
        'array' => 'Campul :attribute trebuie sa aiba cel puțin :min elemente.',
    ],
    'not_in' => 'Campul :attribute selectat nu este valid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Campul :attribute trebuie sa fie un numar.',
    'present' => 'Campul :attribute trebuie sa fie prezent.',
    'regex' => 'Campul :attribute nu are un format valid.',
    'required' => 'Campul :attribute este obligatoriu.',
    'required_if' => 'Campul :attribute este necesar cand :other este :value.',
    'required_unless' => 'Campul :attribute este necesar, cu excepția cazului :other este in :values.',
    'required_with' => 'Campul :attribute este necesar cand exista :values.',
    'required_with_all' => 'Campul :attribute este necesar cand exista :values.',
    'required_without' => 'Campul :attribute este necesar cand nu exista :values.',
    'required_without_all' => 'Campul :attribute este necesar cand niciunul(una) dintre :values nu exista.',
    'same' => 'Campul :attribute si :other trebuie sa fie identice.',
    'size' => [
        'numeric' => 'Campul :attribute trebuie sa fie :size.',
        'file' => 'Campul :attribute trebuie sa aiba :size kiloocteți.',
        'string' => 'Campul :attribute trebuie sa aiba :size caractere.',
        'array' => 'Campul :attribute trebuie sa aiba :size elemente.',
    ],
    'string' => 'Campul :attribute trebuie sa fie string.',
    'timezone' => 'Campul :attribute trebuie sa fie un fus orar valid.',
    'unique' => 'Campul :attribute a fost deja folosit.',
    'uploaded' => 'Campul :attribute nu a reusit incarcarea.',
    'url' => 'Campul :attribute nu este un URL valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
    ],
];
