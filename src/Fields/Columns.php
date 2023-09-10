<?php

/**
 * Add columns field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" with columns by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/columns
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Field;

class Columns extends Field
{

    use GraphQL;
	use ConditionalLogic;

	protected ?string $type = 'acfe_column';

	/**
	 * set defaults on call
	 *
	 * @param string $label
	 * @param string|null $name
	 */
	public function __construct(string $label, ?string $name = null)
	{
		parent::__construct($label, $name);
	}

	/**
	 * Columns
	 * Options: auto, fill, 1/12, 2/12, 3/12, 4/12, 5/12, 6/12, 7/12, 8/12, 9/12, 10/12, 11/12, 12/12
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function columns(string $value): self
	{
		$this->settings['columns'] = $value;

		return $this;
	}

	/**
	 * endpoint
	 * Define an endpoint for the previous columns to stop.
	 *
	 * @return $this
	 */
	public function endpoint(): self
	{
		$this->settings['endpoint'] = true;

		return $this;
	}

	/**
	 * Border
	 * Enable “Column border” and “Fields border”
	 *
	 * Options: column, fields
	 *
	 * @return $this
	 */
	public function border(array $value): self
	{
		$this->settings['border'] = $value;

		return $this;
	}
}
