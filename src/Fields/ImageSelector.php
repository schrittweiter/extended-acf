<?php

/**
 * Add image selector field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" with image selector by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/image-selector
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Settings\Choices;
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\DefaultValue;
use Extended\ACF\Fields\Settings\DirectionLayout;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Multiple;
use Extended\ACF\Fields\Settings\Nullable;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\ReturnFormat;
use Extended\ACF\Fields\Settings\Wrapper;
use Extended\ACF\Fields\Field;

class ImageSelector extends Field
{

    use GraphQL;
	use DefaultValue;
	use Choices;
	use Multiple;
	use Nullable;
	use ReturnFormat;
	use DirectionLayout;
	use ConditionalLogic;
	use Instructions;
	use Required;
	use Wrapper;

	protected ?string $type = 'acfe_image_selector';

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
	 * Container
	 * Choose the image container width, height and border size
	 *
	 * @param string $width
	 * @param string $height
	 * @param int $border
	 * @return $this
	 */
	public function container(string $width = '', string $height = '', int $border = 4): self
	{
		$this->settings['width'] = $width;
		$this->settings['height'] = $height;
		$this->settings['border'] = $border;

		return $this;
	}

	/**
	 * Image size
	 * Choose the default image size
	 *
	 * @return $this
	 */
	public function imageSize(string $size): self
	{
		$this->settings['image_size'] = $size;

		return $this;
	}
}
