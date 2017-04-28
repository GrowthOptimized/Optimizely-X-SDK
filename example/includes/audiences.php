<?php

/**
 * AUDIENCES
 */

// List audiences
// var_dump($optimizely->project($projectId)->audiences());

// Find an audience / NOT WORKING
// var_dump($optimizely->audience($audienceId)->find());

// Create an audience / NOT WORKING
// $optimizely->project($projectId)->createAudience(
// 	'My second audience', 
//     '[\"and\", {\"type\": \"language\", \"value\": \"es\"}, {\"type\": \"location\", \"value\": \"US-CA-SANFRANCISCO\"}]',
//     ["description" => 'People that speak spanish in San Fran']);

//Update an audience
// $optimizely->audience($audienceId)->update([
//     'name' => 'My new name'
// ]);

// Delete an audience
// Not supported by Optimizely Rest API