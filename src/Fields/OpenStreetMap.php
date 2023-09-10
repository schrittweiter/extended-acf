<?php

/**
 * Add Open Street Map field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 *
 */

/**
 * Extend "WordPlate Extended" by following plugin: ACF OpenStreetMap Field
 *
 * @link       https://wordpress.org/plugins/acf-openstreetmap-field/
 * @version    1.3.2
 *
 * @author     Jörn Lund <https://github.com/mcguffin>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;
use Extended\ACF\Fields\Field;
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Nullable;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;

class OpenStreetMap extends Field
{
    use GraphQL;
	use Instructions;
	use Required;
	use Nullable;
	use Wrapper;
	use ConditionalLogic;

	protected ?string $type = 'open_street_map';

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
	 * Height
	 * Customize the map height
	 *
	 * @param string $height
	 * @return $this
	 */
	public function height(string $height): self
	{
		$this->settings['height'] = $height;

		return $this;
	}

	/**
	 * Allow layer selection
	 *
	 * @return $this
	 */
	public function allowMapLayers(): self
	{
		$this->settings['allow_map_layers'] = false;

		return $this;
	}

	/**
	 * Return Format
	 * available options: raw, ... provider based options refer to
	 * https://github.com/mcguffin/acf-openstreetmap-field/blob/master/include/ACFFieldOpenstreetmap/Core/Templates.php#L72
	 *
	 * @param string $return_format
	 * @return $this
	 */
	public function returnFormat(string $return_format): self
	{
		$this->settings['return_format'] = $return_format;

		return $this;
	}

	/**
	 * Map Position
	 * Center the initial map
	 *
	 * @param float $center_lat
	 * @param float $center_lng
	 * @return $this
	 */
	public function centerMap(float $center_lat, float $center_lng): self
	{
		$this->settings['center_lat'] = $center_lat;
		$this->settings['center_lng'] = $center_lng;

		return $this;
	}

	/**
	 * Set zoom, center and select layers being displayed.
	 *
	 * @param int $zoom
	 * @return $this
	 */
	public function zoom(int $zoom): self
	{
		$this->settings['zoom'] = $zoom;

		return $this;
	}

	/**
	 * Max. number of Markers
	 * Leave empty for infinite markers
	 *
	 * @param int $max_markers
	 * @return $this
	 */
	public function maxMarkers(int $max_markers): self
	{
		$this->settings['max_markers'] = $max_markers;

		return $this;
	}

	/**
	 * set layer style to display
	 *
	 *
	 * @param array|string[] $layers
	 * @return $this
	 */
	public function layers(array $layers = ['Stadia.OSMBright']): self
	{
		$this->settings['layers'] = $layers;

		return $this;
	}
}
