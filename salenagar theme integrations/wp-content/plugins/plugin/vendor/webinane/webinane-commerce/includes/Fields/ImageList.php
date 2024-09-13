<?php

namespace WebinaneCommerce\Fields;

use WebinaneCommerce\Fields\Field;

class ImageList extends Field
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
    public $component = 'image-list';

    /**
     * Set image source
     * 
     * @return object
     */
    public function items($items)
    {
        $this->withMeta(['items' => $items]);
        return $this;
    }

    /**
     * Set image source
     * 
     * @return object
     */
    public function width($width)
    {
        $this->withMeta(['width' => $width]);
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
