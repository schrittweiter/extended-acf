<?php

/**
 * Add code editor field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" with code editor by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/code-editor
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\DefaultValue;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Placeholder;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;
use Extended\ACF\Fields\Field;

class CodeEditor extends Field
{

    use GraphQL;
	use DefaultValue;
	use Placeholder;
	use ConditionalLogic;
	use Instructions;
	use Required;
	use Wrapper;

	protected ?string $type = 'acfe_code_editor';

	/**
	 * set defaults on call
	 *
	 * @param string $label
	 * @param string|null $name
	 */
	public function __construct(string $label, ?string $name = null)
	{
		parent::__construct($label, $name);
		$this->mode('text/html');
		$this->indentUnit(4);
		$this->rows(4);
	}

	/**
	 * Choose the syntax highlight
	 * Options: text/html', 'javascript', 'application/x-json', 'css', 'application/x-httpd-php', 'text/x-php'
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function mode(string $value): self
	{

		$this->settings['mode'] = $value;

		return $this;
	}

	/**
	 * Whether to show line numbers to the left of the editor
	 *
	 * @return $this
	 */
	public function lines(): self
	{
		$this->settings['lines'] = true;

		return $this;
	}

	/**
	 * How many spaces a block (whatever that means in the edited language) should be indented
	 *
	 * @param int $value
	 *
	 * @return $this
	 */
	public function indentUnit(int $value): self
	{
		$this->settings['indent_unit'] = $value;

		return $this;
	}

	/**
	 * Leave blank for no limit
	 *
	 * @param int $value
	 *
	 * @return $this
	 */
	public function maxLength(int $value): self
	{
		$this->settings['maxlength'] = $value;

		return $this;
	}

	/**
	 * Sets the textarea height
	 *
	 * @param int $value
	 *
	 * @return $this
	 */
	public function rows(int $value): self
	{
		$this->settings['rows'] = $value;

		return $this;
	}

	/**
	 * Sets the textarea max height
	 *
	 * @param int $value
	 *
	 * @return $this
	 */
	public function maxRows(int $value): self
	{
		$this->settings['max_rows'] = $value;

		return $this;
	}

	/**
	 * Whether to return the value as HTML entities
	 *
	 * @return $this
	 */
	public function returnEntities(): self
	{
		$this->settings['return_entities'] = true;

		return $this;
	}
}
