<?php

namespace WebinaneCommerce\Fields;

use WebinaneCommerce\Fields\Field;

class Image extends Field
{
    /**
     * Add Text.
     *
     * @var string
     */
    public $add_text = '';
    
    /**
     * Update Text
     * 
     * @var string
     */
    public $update_text = '';
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'wpcm-image';

    /**
     * The field's suggestions callback.
     *
     * @var array|callable
     */
    public $suggestions;

    public function lazy()
    {
        $this->withMeta(['lazy' => true]);
        return $this;
    }

    /**
     * Set image source
     * 
     * @return object
     */
    public function src($src)
    {
        $this->withMeta(['src' => $src]);
        return $this;
    }

    /**
     * Set image source
     * 
     * @return object
     */
    public function link($link)
    {
        $this->withMeta(['src' => $link]);
        return $this;
    }

    /**
     * Display the field as raw HTML using Vue.
     *
     * @return $this
     */
    public function asHtml()
    {
        return $this->withMeta(['asHtml' => true]);
    }

    /**
     * Prepare the element for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $this->withMeta(['labelWidth' => '1px']);
        return array_merge(parent::jsonSerialize(), []);
    }
}
