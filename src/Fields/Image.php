<?php

/**
 * Extend Image field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" Image by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/image
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Image as Field;

class Image extends Field
{
    use GraphQL;

	/**
	 * set defaults on call
	 *
	 * @param string $label
	 * @param string|null $name
	 */
	public function __construct(string $label, ?string $name = null)
	{
		parent::__construct($label, $name);

		$this->uploader('default');
	}

	/**
	 * Uploader type - Choose the uploader type
	 * Options: wp, basic
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function uploader(string $value): self
	{
		$this->settings['uploader'] = $value;

		return $this;
	}
}
