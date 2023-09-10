<?php

/**
 * Extend Range field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" Range by following plugin: WPGraphQL for Advanced Custom Fields
 *
 * @link       https://github.com/wp-graphql/wp-graphql-acf
 * @version    0.5.3
 *
 * @author     WPGraphQL <https://github.com/wp-graphql>
 */

namespace Schrittweiter\Acf\Fields;

use Extended\ACF\Fields\Range as Field;
use Schrittweiter\Acf\Fields\Settings\GraphQL;

class Range extends Field
{
    use GraphQL;
}
