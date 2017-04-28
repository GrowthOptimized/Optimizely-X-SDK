<?php

// List Events
// var_dump($optimizely->project($projectId)->events());

// Find Event
// $optimizely->event($eventId)->find();

// Create In-page Event
// $optimizely->page($pageId)->createEvent(
// 	'my sign up goal', 
// 	'click', 
// 	['selector' => '.sign-up-btn'],
// 	['category' => 'sign_up']
// );

// Create Custom Event
// $optimizely->project($projectId)->createCustomEvent([
// 	'event_type' => 'custom',
// 	'name' => 'my custom event',
// 	'key' => 'my_event_key'
// ]));

// Update In-Page Event
// $optimizely->page($pageId)->event($inPageEventId)->update([
//     'name' => 'my new event name 4'
// ]);

// Update Custom Event
// $optimizely->project($projectId)->event($customEventId)->update([
//     'name' => 'my new custom event name'
// ]);

// Delete In-Page Event
// $optimizely->page($pageId)->event($inPageEventId)->delete();

// Delete Custom Event
// $optimizely->project($projectId)->event($customEventId)->delete();