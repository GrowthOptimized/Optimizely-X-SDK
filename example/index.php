<?php

use Dotenv\Dotenv;
use GrowthOptimized\OptimizelyX;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . '/../');
$dotenv->load();

$token = getenv('OPTIMIZELY_TOKEN');

$projectId = 8356600104;
$campaignId = 8358133715;
$experimentId = 8354905861;
$variationId = 7379901245;
$audienceId = 8349110767;
$pageId = 8357433165;
$eventId = 8352801316;
$inPageEventId = 8359171164;
$customEventId = 8349812042;

$optimizely = OptimizelyX::create($token);

// include __DIR__ . '/includes/projects.php';
include __DIR__ . '/includes/campaigns.php';
// include __DIR__ . '/includes/experiments.php';
// include __DIR__ . '/includes/variations.php';
// include __DIR__ . '/includes/audiences.php';
// include __DIR__ . '/includes/pages.php';
// include __DIR__ . '/includes/events.php';
// include __DIR__ . '/includes/attributes.php';
// include __DIR__ . '/includes/results.php';