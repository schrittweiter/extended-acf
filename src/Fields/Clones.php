<?php

/**
 * Extend clone field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" Clone by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/clone
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Settings\Layout;
use Extended\ACF\Fields\Field;
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;

class Clones extends Field
{
    use GraphQL;
	use ConditionalLogic;
	use Instructions;
	use Required;
	use Wrapper;
	use Layout;

	protected ?string $type = 'clone';

	/**
	 * set defaults on call
	 *
	 * @param string $label
	 * @param string|null $name
	 */
	public function __construct(string $label, ?string $name = null)
	{
		parent::__construct($label, $name);

		$this->modalButton(__('Edit','acfe'));
	}

	/**
	 * define clonable fields
	 *
	 * @return $this
	 */
	public function fields(array $value): self
	{
		$this->settings['clone'] = $value;

		return $this;
	}

	/**
	 * define clonable fields
	 * Options: group, seamless
	 *
	 * @return $this
	 */
	public function display(string $value): self
	{
		$this->settings['display'] = $value;

		return $this;
	}

	/**
	 * Labels are displayed as %field_label%.
	 *
	 * @return $this
	 */
	public function prefixLabel(): self
	{
		$this->settings['prefix_label'] = true;

		return $this;
	}

	/**
	 * Values are stored as %field_name%
	 *
	 * @return $this
	 */
	public function prefixName(): self
	{
		$this->settings['prefix_name'] = true;

		return $this;
	}

	/**
	 * Enable better CSS integration: remove borders and padding'
	 *
	 * @return $this
	 */
	public function seamless(): self
	{
		$this->settings['acfe_seamless_style'] = true;

		return $this;
	}

	/**
	 * Edit fields in a modal
	 *
	 * @return $this
	 */
	public function modal(): self
	{
		$this->display('group');
		$this->settings['acfe_clone_modal'] = true;

		return $this;
	}

	/**
	 * Display close button
	 *
	 * @return $this
	 */
	public function modalClose(): self
	{
		$this->modal();
		$this->settings['acfe_clone_modal_close'] = true;

		return $this;
	}

	/**
	 * Text displayed in the edition modal button
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function modalButton(string $value): self
	{
		$this->settings['acfe_clone_modal_button'] = $value;

		return $this;
	}

	/**
	 * Choose the modal size
	 * Options: small, medium, large, xlarge, full
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function modalSize(string $value): self
	{
		$this->settings['acfe_clone_modal_size'] = $value;

		return $this;
	}
}
