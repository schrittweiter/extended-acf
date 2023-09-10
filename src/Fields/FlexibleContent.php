<?php

/**
 * Extend flexbible content field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" flexible content by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/flexible-content
 * @version    0.8.8.6
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\FlexibleContent as Field;

class FlexibleContent extends Field
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

        $this->advanced();
    }

    /**
     * Show advanced Flexible Content settings
     *
     * @return $this
     */
    public function advanced(): self
    {
		$this->settings['acfe_flexible_advanced'] = true;

        return $this;
    }

    /**
     * Better actions buttons integration
     * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings#stylised-button
     *
     * @return $this
     */
    public function stylisedButton(): self
    {
		$this->settings['acfe_flexible_stylised_button'] = true;

        return $this;
    }

    /**
     * Edit layout content in a modal
     * https://www.acf-extended.com/features/fields/flexible-content/modal-settings#edit-modal
     *
     * small, medium, large, xlarge, full
     *
     * @return $this
     */
    public function modalEdit(string $size = 'full'): self
    {
		$this->settings['acfe_flexible_modal_edit'] = [
            'acfe_flexible_modal_edit_enabled' => true,
            'acfe_flexible_modal_edit_size' => $size
        ];

        return $this;
    }

    /**
     * Select layouts in a modal
     * https://www.acf-extended.com/features/fields/flexible-content/modal-settings#selection-modal
     *
     * @param string $size
     * @param string $title
     * @param int $cols
     * @param bool $cats
     * @return $this
     */
    public function modalSelection(string $size = 'full', string $title = 'Choose Layout', int $cols = 4, bool $cats = false): self
    {
		$this->settings['acfe_flexible_modal'] = [
            'acfe_flexible_modal_enabled' => true,
            'acfe_flexible_modal_title' => $title,
            'acfe_flexible_modal_size' => $size,
            'acfe_flexible_modal_col' => $cols,
            'acfe_flexible_modal_categories' => $cats

        ];

        return $this;
    }

    /**
     * Enable columns mode
     * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings#columns-mode
     *
     * @param string $align
     * @param string $vAlign
     * @param bool $nowrap
     * @return $this
     */
    public function grid(string $align = 'center', string $vAlign = 'stretch', $nowrap = 0): self
    {
		$this->settings['acfe_flexible_grid'] = [
            'acfe_flexible_grid_enabled' => true,
            'acfe_flexible_grid_align' => $align,
            'acfe_flexible_grid_valign' => $vAlign,
            'acfe_flexible_grid_wrap' => $nowrap

        ];

        return $this;
    }

    /**
     * Render the layout using custom template, style & javascript files
     * https://www.acf-extended.com/features/fields/flexible-content/dynamic-render
     *
     * @return $this
     */
    public function templates(): self
    {

		$this->settings['acfe_flexible_layouts_templates'] = true;

        return $this;
    }

    /**
     * Layouts Placeholder
     * Display a placeholder with an icon.
     *
     * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings#layouts-placeholder
     *
     * @return $this
     */
    public function placeholder(): self
    {
		$this->settings['acfe_flexible_layouts_placeholder'] = true;

        return $this;
    }

    /**
     * Use layouts render settings to display a dynamic preview in the administration
     * https://www.acf-extended.com/features/fields/flexible-content/dynamic-render#dynamic-preview
     *
     * @return $this
     */
    public function previews(): self
    {
		$this->settings['acfe_flexible_layouts_previews'] = true;

        return $this;
    }

    /**
     * Layouts Thumbnails
     * Set a thumbnail for each layouts.
     *
     * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings#layouts-thumbnails
     *
     * @return $this
     */
    public function thumbnails(): self
    {
		$this->settings['acfe_flexible_layouts_thumbnails'] = true;

        return $this;
    }

    /**
     * Layouts Settings Modal
     * Choose a field group to clone and to be used as a configuration modal.
     *
     * https://www.acf-extended.com/features/fields/flexible-content/modal-settings#settings-modal
     *
     * @return $this
     */
    public function settings(): self
    {
		$this->settings['acfe_flexible_layouts_settings'] = true;

        return $this;
    }

    /**
     * Asynchronous Settings
     *
     * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings#async-settings
     *
     * @return $this
     */
    public function ajax(): self
    {
		$this->settings['acfe_flexible_layouts_ajax'] = true;

        return $this;
    }


    /**
     * Additional Actions
     *
     * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings
     *
     * Possible values: title, toggle, copy, lock, close
     *
     * @param array $actions
     * @return $this
     */
    public function addActions(array $actions): self
    {
		$this->settings['acfe_flexible_add_actions'] = $actions;

        return $this;
    }

    /**
     * Empty Message ( Text displayed when the flexible field is empty )
     *
     * https://www.acf-extended.com/features/fields/flexible-content/advanced-settings#empty-message
     *
     * @param string $message
     * @return $this
     */
    public function emptyMessage(string $message): self
    {
		$this->settings['acfe_flexible_empty_message'] = $message;

        return $this;
    }

    /**
     * Add support for location rules
     *
     * https://www.acf-extended.com/features/fields/flexible-content/location-rules
     *
     * @return $this
     */
    public function hasLocations(): self
    {
        $this->settings['acfe_flexible_layouts_locations'] = true;

        return $this;
    }
}
