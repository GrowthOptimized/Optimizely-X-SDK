<?php

// List Events
// var_dump($optimizely->project($projectId)->events()->all());

// Find Event
var_dump($optimizely->event($customEventId)->find());

// Create In-page Event
// var_dump($optimizely->page($pageId)->events()->create(
// 	'my sign up goal', 
// 	'click', 
// 	['selector' => '.sign-up-btn'],
// 	['category' => 'sign_up']
// ));

// Create Custom Event
// var_dump($optimizely->project($projectId)->events()->create([
// 	'event_type' => 'custom',
// 	'name' => 'my new custom event 3',
// 	'key' => 'my_new_event_key_3'
// ]));

// Update In-Page Event
// var_dump($optimizely->page($pageId)->event($inPageEventId)->update([
//     'name' => 'my new event name 5'
// ]));

// Update Custom Event
// var_dump($optimizely->project($projectId)->event($customEventId)->update([
//     'name' => 'my new custom event name'
// ]));

// Delete In-Page Event
// var_dump($optimizely->page($pageId)->event($inPageEventId)->delete());

// Delete Custom Event
// var_dump($optimizely->project($projectId)->event($customEventId)->delete());