<?php

// A tiny rules based validator. Pass data and rules, get back a map of errors.
// Rules per field, pipe separated: required, email, numeric, max:NN, min:NN.
function validateFields(array $data, array $rules): array
{
    $errors = [];
    foreach ($rules as $field => $ruleset) {
        $value = $data[$field] ?? '';
        foreach (explode('|', $ruleset) as $rule) {
            [$name, $param] = array_pad(explode(':', $rule, 2), 2, null);
            if ($name === 'required' && trim((string) $value) === '') {
                $errors[$field][] = 'required';
            } elseif ($name === 'email' && $value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field][] = 'must be a valid email';
            } elseif ($name === 'max' && strlen((string) $value) > (int) $param) {
                $errors[$field][] = 'too long';
            } elseif ($name === 'min' && strlen((string) $value) < (int) $param) {
                $errors[$field][] = 'too short';
            } elseif ($name === 'numeric' && $value !== '' && !is_numeric($value)) {
                $errors[$field][] = 'must be a number';
            }
        }
    }
    return $errors;
}
