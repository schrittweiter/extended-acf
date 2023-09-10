<?php

/**
 * Add button field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" with button by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/button
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Extended\ACF\Fields\Settings\ConditionalLogic;
use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;
use Extended\ACF\Fields\Field;

class Button extends Field
{

    use GraphQL;
	use Required;
	use ConditionalLogic;
	use Wrapper;
	use Instructions;

	protected ?string $type = 'acfe_button';

	/**
	 * set defaults on call
	 *
	 * @param string $label
	 * @param string|null $name
	 */
	public function __construct(string $label, ?string $name = null)
	{
		parent::__construct($label, $name);

		$this->buttonValue(__('Submit', 'acfe'));
		$this->buttonType('button');
		$this->buttonClass('button button-secondary');

	}

	/**
	 * Set a default button value
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function buttonValue(string $value): self
	{

		$this->settings['button_value'] = $value;

		return $this;
	}

	/**
	 * Choose the button type
	 * Options: button, submit
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function buttonType(string $value): self
	{

		$this->settings['button_type'] = $value;

		return $this;
	}

	/**
	 * Custom HTML before the button
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function buttonBefore(string $value): self
	{

		$this->settings['button_before'] = $value;

		return $this;
	}

	/**
	 * Custom HTML after the button
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function buttonAfter(string $value): self
	{

		$this->settings['button_after'] = $value;

		return $this;
	}

	/**
	 * Button attributes (classes)
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function buttonClass(string $value): self
	{

		$this->settings['button_class'] = $value;

		return $this;
	}

	/**
	 * Button attributes (id)
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function buttonId(string $value): self
	{

		$this->settings['button_id'] = $value;

		return $this;
	}

	/**
	 * Trigger ajax event on click
	 *
	 * @link       https://www.acf-extended.com/features/fields/button
	 *
	 * @return $this
	 */
	public function buttonAjax(): self
	{

		$this->settings['button_ajax'] = true;

		return $this;
	}
}
