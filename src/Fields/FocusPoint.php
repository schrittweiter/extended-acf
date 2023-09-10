<?php

/**
 * Add FocusPoint field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" by following plugin: ACF: FocusPoint
 *
 * @link       https://github.com/ooksanen/acf-focuspoint
 * @version    1.2.0
 *
 * @author     ooksanen <https://github.com/ooksanen>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Field;
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Library;
use Extended\ACF\Fields\Settings\MimeTypes;
use Extended\ACF\Fields\Settings\Nullable;
use Extended\ACF\Fields\Settings\PreviewSize;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;

class FocusPoint extends Field
{
    use GraphQL;
	use Instructions;
	use Required;
	use Nullable;
	use Wrapper;
	use Library;
	use MimeTypes;
	use PreviewSize;
	use ConditionalLogic;

	protected ?string $type = 'focuspoint';

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
}
