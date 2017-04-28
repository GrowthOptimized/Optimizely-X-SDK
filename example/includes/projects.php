<?php

/**
 * PROJECTS:
 */

// // List projects in account
var_dump($optimizely->projects()->all());

// Read a project
// $optimizely->projects()->find($projectId);

// // Create a project
// $optimizely->projects()->create('My new project', []);

// // Update a project
// $optimizely->project($projectId)->update(['name' => 'My new name']);

// // Delete a project
// // Not supported by Optimizely Rest API

// // Activate a project
// $optimizely->project($projectId)->activate();

// // Archive a project
// $optimizely->project($projectId)->archive();