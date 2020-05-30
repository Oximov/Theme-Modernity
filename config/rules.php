<?php


return [
    'discord-id' => ['nullable', 'string'],
    'twitter' => ['nullable', 'string'],
    'title' => ['nullable', 'string'],
    'subtitle' => ['nullable', 'string'],
    'use_play_button' => ['filled'],
    'play_button_link' => ['nullable:use_play_button'],
];
