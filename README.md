# ACF Fields

Creating custom fields programmatically with the help of [Wordplate/Extended ACF](https://github.com/wordplate/extended-acf) makes it easy to maintain and extend a clean setup for your Wordpress custom fields.

The aim of this repository is to create a pool of custom field types to spare you coding time. Feel free to extend this library.

## Installation

1. Run `composer require schrittweiter/acf` in your theme folder
2. Make sure you are autoloading your composer vendors e.g.
```php
require_once __DIR__.'/vendor/autoload.php';
```

## Usage
Now you can make use of the fields like this (Please refer to the docs of wordplate in order to understand how to setup)
```php
<?php
  use WordPlate\Acf\Location;
  use WordPlate\Acf\Image;
  use WordPlate\Acf\Text;
  use Schrittweiter\Acf\Fields\Button; // Our new Field type

  add_action('acf/init', function() {
    register_extended_field_group([
      'title' => 'About',
      'fields' => [
        Image::make('Image'),
        Text::make('Title'),
        Button::make('My Button', 'button') // gets registered here
      ],
      'location' => [
        Location::if('post_type', 'page')
      ],
    ]);
  });
```

and thats it! Happy creating

## Supported third-party plugins


## [Advanced Custom Fields: Extended Pro](https://www.acf-extended.com/)

We have currently implemented some custom fields from ACF Extended Pro. All custom fields listed here are based on version 0.8.8.6 of the plugin.

### [Advanced Link](https://www.acf-extended.com/features/fields/advanced-link)


Display a modern Link Selector in a modal which allow customization. Posts, Post Types Archives & terms selection can be filtered in the field administration.

For more details visit: (https://www.acf-extended.com/features/fields/advanced-link)

**Usage example:**

```php
<?php

use Schrittweiter\Acf\Fields\AdvancedLink;

AdvancedLink::make('LINK LABEL','link_fieldname')
    ->postType(['post']) // array, Filter which Post Types are allowed
    ->taxonomy(['category']) // array, Filter which Taxonomies are allowed
```
___

## [ACF: FocusPoint](https://github.com/ooksanen/acf-focuspoint)

Adds a new field type to ACF allowing users to select a focal point on image.

The plugin developer is looking for sponsors, if you like this plugin, buy him a beer by clicking the Sponsor button at his repo https://github.com/ooksanen/acf-focuspoint

**Usage example:**

```php
<?php

use Schrittweiter\Acf\Fields\FocusPoint;

FocusPoint::make('FOCUS POINT LABEL','focuspoint_fieldname')
    ->instructions('Select Image.')
    ->required()
    ->mimeTypes(['jpg', 'jpeg', 'png'])
    ->previewSize('medium') // thumbnail, medium or large
    ->library('all') // all or uploadedTo
```
___

## [ACF OpenStreetMap Field](https://wordpress.org/plugins/acf-openstreetmap-field/)

Adds a new field type to ACF for a hazzle free OpenStreetMap.

**Usage example:**

```php
<?php

use Schrittweiter\Acf\Fields\OpenStreetMap;

OpenStreetMap::make('OPEN STREET MAP LABEL','openstreetmap_fieldname')
    ->required()

```
___

## Todos

- [ ] Complete ACF-Extended integration
- [ ] Complete OpenStreetMap - documentation
- [ ] Add to wpackagist instead of packagist, since this is a WP only extension
