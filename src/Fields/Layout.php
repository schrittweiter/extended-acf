<?php

/**
 * Extend layout field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" layout by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/flexible-content
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Layout as Field;

class Layout extends Field
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

        $this->modalSize();
    }


    /**
     * Modal settings
     * https://www.acf-extended.com/features/fields/flexible-content/modal-settings#edit-modal
     *
     * small, medium, large, xlarge, full
     *
     * @return $this
     */
    public function modalSize(string $size = ''): self
    {
		$this->settings['acfe_flexible_modal_edit_size'] = $size;

        return $this;
    }

    /**
     * Clone settings
     * Choose a field group to clone and to be used as a configuration modal.
     *
     *  size options: small, medium, large, xlarge, full
     *
     * https://www.acf-extended.com/features/fields/flexible-content/modal-settings#settings-modal
     *
     * @return $this
     */
    public function settingsClone(array $fieldgroups, string $size = ''): self
    {
		$this->settings['acfe_flexible_settings_size'] = $size;
		$this->settings['acfe_flexible_settings'] = $fieldgroups;

        return $this;
    }

    /**
     * Category
     * Enable the layouts categories tabs. This setting will display a new category setting for each layouts.
     *
     * https://www.acf-extended.com/features/fields/flexible-content/modal-settings#selection-modal
     *
     * @return $this
     */
    public function category(array $categories = []): self
    {
		$this->settings['acfe_flexible_category'] = $categories;

        return $this;
    }

    /**
     * Default Column
     * Define the default column size when the layout is being added
     *
     * options: 0 = auto, 1, 2 ,3 ,4 ,5 , 6, 7, 8, 9, 10, 11, 12
     *
     * https://www.acf-extended.com/features/fields/flexible-content/grid-system#layouts-grid-settings
     *
     * @return $this
     */
    public function defaultColumn(int $size = 12): self
    {
		$this->settings['acfe_layout_col'] = $size;

        return $this;
    }

    /**
     * Allowed Column
     * Define the allowed columns the user can choose
     *
     * options: array 0 = auto, 1, 2 ,3 ,4 ,5 , 6, 7, 8, 9, 10, 11, 12
     *
     * https://www.acf-extended.com/features/fields/flexible-content/grid-system#layouts-grid-settings
     *
     * @return $this
     */
    public function allowedColumns(array $size = []): self
    {
		$this->settings['acfe_layout_allowed_col'] = $size;

        return $this;
    }

    /**
     * Add support for Layout location rules
     *
     *
     * https://www.acf-extended.com/features/fields/flexible-content/location-rules#layouts-location-rules
     *
     * @return $this
     */
    public function locations(array $rules = []): self
    {
        $ruleSetting = array_map(fn ($location) => $location->get(), $rules);
		$this->settings['acfe_layout_locations'] = $ruleSetting;

        return $this;
    }

    /**
     * Render the layout using custom template, style & javascript files
     * https://www.acf-extended.com/features/fields/flexible-content/dynamic-render
     *
     * @param array $files
     * @return $this
     */
    public function render(array $files = []): self
    {

		$this->settings['acfe_flexible_render_template'] = $files['template'] ?? '';
		$this->settings['acfe_flexible_render_style'] = $files['style'] ?? '';
		$this->settings['acfe_flexible_render_script'] = $files['script'] ?? '';

        return $this;
    }
}
