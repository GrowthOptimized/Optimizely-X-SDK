<?php

/**
 * EXPERIMENTS:
 */

// List experiments in project
// $optimizely->project($projectId)->experiments();

// Find experiment 
// $optimizely->experiment($experimentId)->find();

// Create an experiment
// $optimizely->project($projectId)->createExperiment(
//     'my new new test',
//     'http://www.widerfunnel.com',
//     [
//     	"variations" => [
//     	    [
//     			"name" => "control",
//     			"weight" => 5000
//     		],
//     		[
//     			"name" => "varA",
//     			"weight" => 5000
//     		]
//     	],
//     	"metrics" => [
//     		[
//     			"aggregator" => "unique",
//       			"event_id" => 0,
//       			"field" => "revenue"
//       		]
//     	]
//     ]
// );

// Update an experiment
// $optimizely->experiment($experimentId)->update(['name' => 'my new name']);

// Delete an experiment 
// $optimizely->experiment($experimentId)->delete();

// Archive an experiment
// $optimizely->experiment($experimentId)->archive();