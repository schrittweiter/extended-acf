<?php

/**
 * Extend Accordion field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" Accordion by following plugin: WPGraphQL for Advanced Custom Fields
 *
 * @link       https://github.com/wp-graphql/wp-graphql-acf
 * @version    0.5.3
 *
 * @author     WPGraphQL <https://github.com/wp-graphql>
 */

namespace Schrittweiter\Acf\Fields;

use Extended\ACF\Fields\Accordion as Field;
use Schrittweiter\Acf\Fields\Settings\GraphQL;

class Accordion extends Field
{
    use GraphQL;
}
