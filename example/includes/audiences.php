<?php

/**
 * AUDIENCES
 */

// List audiences
// var_dump($optimizely->project($projectId)->audiences()->all());

// Find an audience
// var_dump($optimizely->audience($audienceId)->find());

// Create an audience
// $optimizely->project($projectId)->audiences()->create(
// 	'My french audience', 
//     "[\"and\", {\"type\": \"language\", \"value\": \"fa\"}]",
//     ["description" => 'People that speak speak french']);

//Update an audience
// $optimizely->audience($audienceId)->update([
//     'name' => 'My new name'
// ]);

// Delete an audience
// Not supported by Optimizely Rest API