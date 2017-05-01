<?php

// Update variations
var_dump($optimizely->experiment($experimentId)->variations()->update([
    [
        "name" => "control",
        "weight" => 2500
    ],
    [
        "name" => "varA",
        "weight" => 2500
    ],
    [
        "name" => "varB",
        "weight" => 2500
    ],
	[
        "name" => "varF",
        "weight" => 2500
    ]
]));
