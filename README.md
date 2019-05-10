# OPTIMIZELY X PHP SDK
[![Packagist](https://img.shields.io/packagist/v/WiderFunnel/optimizely-x-sdk.svg?maxAge=2592000?style=flat-square)](https://packagist.org/packages/widerfunnel/optimizely-x-sdk)
[![Travis](https://img.shields.io/travis/WiderFunnel/optimizely-x-sdk/master.svg?maxAge=2592000?style=flat-square)](https://travis-ci.org/widerfunnel/optimizely-x-sdk)

[Optimizely X token generator](https://app.optimizely.com/v2/profile/api)

PHP Wrapper to interact with the Optimizely X API.

## Installation

```bash
composer require widerfunnel/optimizely-x-sdk
```

## Usage

Simply create an Optimizely object, with a valid OAuth Token in the constructor:

```php
$optimizely = Optimizely::create($token);
```

If you wish to use the token based authentication, simply pass `true` as a second argument:

```php
$optimizely = Optimizely::create($token, true);
```

List projects

```php
$optimizely->projects()->all();
```

Read a project

```php
$optimizely->projects()->find($projectId);
```

Create a project

```php
$optimizely->projects()->create([
    'name' => 'My new project'
]);
```

Update a project

```php
$optimizely->project($projectId)->update([
    'name' => 'My new name'
]);
```

Delete a project

** Not supported by Optimizely X Rest API **

Activate a project (note: not functional, waiting on optimizely X api fix)

```php
$optimizely->project($projectId)->activate();
```

Archive a project (note: not functional, waiting on optimizely X api fix)

```php
$optimizely->project($projectId)->archive();
```

### Campaigns

List Campaigns

```php
$optimizely->project($projectId)->campaigns()->all();
```

Find Campaign

```php
$optimizely->campaign($campaignId)->find();
```

Create Campaign

```php
$optimizely->project($projectId)->campaigns()->create(
    'Landing Page Optimization',
    ["status" => "not_started"]
);
```

Update a Campaign

```php
$optimizely->campaign($campaignId)->update([
    'name' => 'this is my new campaign'
]);
```

### Experiments

List experiments in project

```php
$optimizely->project($projectId)->experiments()->all([
    'per_page' => <integer>,
    'page' => <integer>,
    'include_classic' => <boolean>
] <optional>);
```

Find experiment

```php
$optimizely->experiment($experimentId)->find();
```

Create an experiment

```php
$optimizely->project($projectId)->experiments()->create(
    'my test',
    [
        [
            "name" => "control",
            "weight" => 5000
        ],
        [
            "name" => "varA",
            "weight" => 5000
        ]
    ],
    [
        [
            "aggregator" => "unique",
            "event_id" => 0,
            "field" => "revenue"
        ]
    ],
    ['status' => 'not started']
]);
```
Update an experiment

```php
$optimizely->experiment($experimentId)->update(['name' => 'newsite.com']);
```

Delete an experiment

```php
$optimizely->experiment($experimentId)->delete();
```

Archive an experiment

```php
$optimizely->experiment($experimentId)->archive();
```

### Variations


Change Variations

```php
$optimizely->experiment($experimentId)->variations()->update([
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
]);
```

### Audiences

List audiences

```php
$optimizely->project($projectId)->audiences()->all();
```

Find an audience

```php
$optimizely->audience($audienceId)->find();
```

Create an audience

```php
$optimizely->project($projectId)->audiences()->create(
    'My second audience',
    '[\"and\", {\"type\": \"language\", \"value\": \"es\"}, {\"type\": \"location\", \"value\": \"US-CA-SANFRANCISCO\"}]',
    ["description" => 'People that speak spanish in San Fran']
);
```

Update an audience

```php
$optimizely->audience($audienceId)->update([
    'name' => 'My new name'
]);
```

Delete an audience

** Not supported by Optimizely X Rest API **

### Pages

List Pages

```php
$optimizely->project($projectId)->pages()->all();
```

Find a Page

```php
$optimizely->page($pageId)->find();
```

Create a page

```php
$optimizely->project($projectId)->pages()->create($name, $edit_url, [
    'category' => 'article'
]);
```

Update a page

```php
$optimizely->page($pageId)->update(['name' => 'my updated name']);
```

Delete a page

```php
$optimizely->page($pageId)->delete();
```

### Events

List Events

```php
$optimizely->project($projectId)->events()->all();
```

Find Event

```php
$optimizely->event($eventId)->find();
```

#### In Page Events

Create In-page Event

```php
$optimizely->page($pageId)->events()->create(
    'my sign up goal',
    'click',
    ['selector' => '.sign-up-btn'],
    ['category' => 'sign_up']
);
```

Update In-Page Event

```php
$optimizely->page($pageId)->event($inPageEventId)->update([
    'name' => 'my new page event name'
]);
```

Delete In-Page Event

```php
$optimizely->page($pageId)->event($inPageEventId)->delete();
```

#### Custom Event

Create Custom Event

```php
$optimizely->project($projectId)->events()->create([
    'event_type' => 'custom',
    'name' => 'my custom event',
    'key' => 'my_event_key'
]);
```

Update Custom Event

```php
$optimizely->project($projectId)->event($customEventId)->update([
    'name' => 'my new custom event name'
]);
```

Delete Custom Event

```php
$optimizely->project($projectId)->event($customEventId)->delete();
```

### Attributes

List Attributes

```php
$optimizely->project($projectId)->attributes()->all();
```

Find Attribute

```php
$optimizely->attribute($attributeId)->find());
```

Create Attribute

```php
$optimizely->project($projectId)->attributes()->create(
    'my new attribute',
    'my_new_attribute',
    ['description' => 'this is an attribute']
);
```

Update Attribute

```php
$optimizely->attribute($attributeId)->update(['name' => 'this is my updated attribute']);
```

Delete Attribute

```php
$optimizely->attribute($attributeId)->delete());
```

### Results

Fetch the results of an experiment

```php
$optimizely->experiment($experimentId)->results();
```

Fetch the results of an campaign

```php
$optimizely->campaign($campaignId)->results();
```
