<?php

$colors = ['red', 'blue', 'green', 'purple', 'orange', 'yellow', 'aqua', 'pink'];

return [
    'color' => ['required', \Illuminate\Validation\Rule::in($colors)],
    'discord-id' => ['nullable', 'string'],
    'twitter' => ['nullable', 'string'],
    'title' => ['nullable', 'string'],
    'subtitle' => ['nullable', 'string'],
];
