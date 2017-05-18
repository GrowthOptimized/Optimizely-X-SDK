<?php

use Dotenv\Dotenv;
use GrowthOptimized\OptimizelyX;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__ . '/../');
$dotenv->load();

$token = getenv('OPTIMIZELY_TOKEN');

$projectId = 8395421185;
$campaignId = 8358133715;
$experimentId = 8348094537;
$variationId = 7379901245;
$audienceId = 8355388303;
$pageId = 8359424378;
$eventId = 8359424378;
$inPageEventId = 8350928181;
$customEventId = 8360592757;
$attributeId = 8357910112;

$optimizely = OptimizelyX::create($token);

include __DIR__ . '/includes/projects.php';
include __DIR__ . '/includes/campaigns.php';
include __DIR__ . '/includes/experiments.php';
include __DIR__ . '/includes/variations.php';
include __DIR__ . '/includes/audiences.php';
include __DIR__ . '/includes/pages.php';
include __DIR__ . '/includes/events.php';
include __DIR__ . '/includes/attributes.php';
include __DIR__ . '/includes/results.php';