<?php

/**
 * Add DateRangerPicker field to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" with date range picker by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/date-range-picker
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Extended\ACF\Fields\Settings\Nullable;
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Settings\DateTimeFormat;
use Extended\ACF\Fields\Settings\Disabled;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Placeholder;
use Extended\ACF\Fields\Settings\Writable;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\WeekDay;
use Extended\ACF\Fields\Settings\Wrapper;
use Extended\ACF\Fields\Field;

class DateRangePicker extends Field
{
	use GraphQL;
	use Nullable;
	use ConditionalLogic;
	use DateTimeFormat;
	use Disabled;
	use Instructions;
	use Placeholder;
	use Writable;
	use Required;
	use WeekDay;
	use Wrapper;

	protected ?string $type = 'acfe_date_range_picker';

	/**
	 * set defaults on call
	 *
	 * @param string $label
	 * @param string|null $name
	 */
	public function __construct(string $label, ?string $name = null)
	{
		parent::__construct($label, $name);
		$this->custom_ranges(['Today','Yesterday', 'Last 7 Days', 'Last 30 Days', 'This Month', 'Last Month']);

	}

	/**
	 * Separator
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function separator(string $value): self
	{
		$this->settings['separator'] = $value;

		return $this;
	}

	/**
	 * Default Start
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function default_start(string $value): self
	{
		$this->settings['default_start'] = $value;

		return $this;
	}

	/**
	 * Default Start
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function default_end(string $value): self
	{
		$this->settings['default_end'] = $value;

		return $this;
	}

	/**
	 * Min Range
	 *
	 * @param int $value
	 *
	 * @return $this
	 */
	public function min_range(int $value): self
	{
		$this->settings['min_days'] = $value;

		return $this;
	}

	/**
	 * Max Range
	 *
	 * @param int $value
	 *
	 * @return $this
	 */
	public function max_range(int $value): self
	{
		$this->settings['max_days'] = $value;

		return $this;
	}

	/**
	 * Min date
	 *
	 * Enter a date based on the "Display Format" setting. Relative dates must be compatible with strtotime() PHP function.
	 * For example, +1 month +7 days represents one month and seven days from today.
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function min_date(string $value): self
	{
		$this->settings['min_date'] = $value;

		return $this;
	}

	/**
	 * Max date
	 *
	 * Enter a date based on the "Display Format" setting. Relative dates must be compatible with strtotime() PHP function.
	 * For example, +1 month +7 days represents one month and seven days from today.
	 *
	 * @param string $value
	 *
	 * @return $this
	 */
	public function max_date(string $value): self
	{
		$this->settings['max_date'] = $value;

		return $this;
	}

	/**
	 * Custom Ranges
	 * Define the custom ranges the user can choose
	 *
	 * options: array Today, Yesterday, Last 7 Days, Last 30 Days, This Month, Last Month
	 *
	 * https://www.acf-extended.com/features/fields/flexible-content/grid-system#layouts-grid-settings
	 *
	 * @return $this
	 */
	public function custom_ranges(array $ranges = []): self
	{
		$this->settings['custom_ranges'] = $ranges;

		return $this;
	}

	/**
	 * Show dropdowns
	 *
	 * @return $this
	 */
	public function dropdowns(): self
	{
		$this->settings['show_dropdowns'] = true;

		return $this;
	}

	/**
	 * Hide Weekends
	 *
	 * @return $this
	 */
	public function no_weekends(): self
	{
		$this->settings['no_weekends'] = true;

		return $this;
	}

	/**
	 * Auto close after selection
	 *
	 * @return $this
	 */
	public function auto_close(): self
	{
		$this->settings['auto_close'] = true;

		return $this;
	}
}
