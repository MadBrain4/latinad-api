<?php
    return [
        'validation_failed' => 'Validation failed.',
        'required' => 'The :attribute field is required.',
        'email' => 'You must enter a valid email address.',
        'attributes' => [
            'email' => 'email address',
            'password' => 'password',
        ],
        'language' => [
            'required' => 'The language is required.',
            'string' => 'The language must be a string.',
            'size' => 'The language must be exactly 2 characters.',
            'in' => 'The selected language is invalid.',
        ],
        'display' => [
            'name_required' => 'Please enter the display name.',
            'name_string' => 'The name must be a valid string.',
            'name_max' => 'The name may not exceed 255 characters.',
            'description_required' => 'The description is required for the display.',
            'description_string' => 'The description must be a valid string.',
            'price_per_day_required' => 'Please provide the price per day.',
            'price_per_day_numeric' => 'The price per day must be a valid number.',
            'price_per_day_min' => 'The price per day cannot be negative.',
            'resolution_height_required' => 'The resolution height is required.',
            'resolution_height_integer' => 'The resolution height must be an integer.',
            'resolution_height_min' => 'The resolution height must be at least 1.',
            'resolution_width_required' => 'The resolution width is required.',
            'resolution_width_integer' => 'The resolution width must be an integer.',
            'resolution_width_min' => 'The resolution width must be at least 1.',
            'type_required' => 'The display type is required.',
            'type_in' => 'The type must be either "indoor" or "outdoor".',
            'failed' => 'There was an error validating the display.',
        ],
    ];
