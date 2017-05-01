<?php

/**
 * EXPERIMENTS:
 */

// List experiments in project
// var_dump($optimizely->project($projectId)->experiments()->all());

// Find experiment 
// var_dump($optimizely->experiment($experimentId)->find());

// Create an experiment
// var_dump($optimizely->project($projectId)->experiments()->create(
// 	'my experiment',
//     [
// 	    [
// 			"name" => "control",
// 			"weight" => 5000
// 		],
// 		[
// 			"name" => "varA",
// 			"weight" => 5000
// 		]
//     ],
//     [
//     	[
// 			"aggregator" => "unique",
//   			"event_id" => 0,
//   			"field" => "revenue"
//       	]
//     ]
// ));

// Update an experiment
// var_dump($optimizely->experiment($experimentId)->update(['name' => 'my new name']));

// Delete an experiment 
// var_dump($optimizely->experiment($experimentId)->delete());

// Archive an experiment
// $optimizely->experiment($experimentId)->archive();