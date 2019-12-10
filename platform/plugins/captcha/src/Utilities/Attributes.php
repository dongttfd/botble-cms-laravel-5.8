<?php

namespace Botble\Captcha\Utilities;

use Botble\Captcha\Contracts\Utilities\AttributesContract;
use Botble\Captcha\Exceptions\InvalidArgumentException;
use Botble\Captcha\Captcha;

class Attributes implements AttributesContract
{

    /**
     * Attribute collection.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Defaults attributes.
     *
     * @var array
     */
    protected $defaults = [];

    /**
     * Attributes constructor.
     *
     * @param  array $defaults
     * @author ARCANEDEV
     */
    public function __construct(array $defaults = [])
    {
        $this->defaults = array_filter($defaults);
    }

    /**
     * Get all items.
     *
     * @param  string $siteKey
     *
     * @return array
     * @author ARCANEDEV
     */
    protected function getItems($siteKey)
    {
        return array_merge(
            $this->getDefaultAttributes($siteKey),
            $this->items
        );
    }

    /**
     * Get Default attributes.
     *
     * @param  string $siteKey
     *
     * @return array
     * @author ARCANEDEV
     */
    private function getDefaultAttributes($siteKey)
    {
        return [
            'class'        => 'g-recaptcha',
            'data-sitekey' => $siteKey,
        ];
    }

    /**
     * Set items.
     *
     * @param  array $items
     *
     * @return self
     * @author ARCANEDEV
     */
    private function setItems(array $items)
    {
        $this->items = array_merge($this->defaults, $items);

        $this->checkAttributes();

        return $this;
    }

    /**
     * Get an item value by name.
     *
     * @param  string $name
     *
     * @return string
     * @author ARCANEDEV
     */
    private function getItem($name)
    {
        if (!$this->hasItem($name)) {
            return null;
        }

        return $this->items[$name];
    }

    /**
     * Set an item.
     *
     * @param  string $name
     * @param  string $value
     *
     * @return self
     * @author ARCANEDEV
     */
    private function setItem($name, $value)
    {
        $this->items[$name] = $value;

        return $this;
    }

    /**
     * Get image type attribute.
     *
     * @return array
     * @author ARCANEDEV
     */
    public function getImageAttribute()
    {
        return [self::ATTR_TYPE => 'image'];
    }

    /**
     * Get audio type attribute.
     *
     * @return array
     * @author ARCANEDEV
     */
    public function getAudioAttribute()
    {
        return [self::ATTR_TYPE => 'audio'];
    }

    /**
     * Build attributes.
     *
     * @param  string $siteKey
     * @param  array $items
     *
     * @return string
     * @author ARCANEDEV
     */
    public function build($siteKey, array $items = [])
    {
        $this->setItems($items);

        $output = [];

        foreach ($this->getItems($siteKey) as $key => $value) {
            $output[] = trim($key) . '="' . trim($value) . '"';
        }

        return implode(' ', $output);
    }

    /**
     * Prepare the name and id attributes.
     *
     * @param  string|null $name
     *
     * @return array
     *
     * @throws \Botble\Captcha\Exceptions\InvalidArgumentException
     * @author ARCANEDEV
     */
    public function prepareNameAttribute($name)
    {
        if (empty($name)) {
            return [];
        }

        if ($name === Captcha::CAPTCHA_NAME) {
            throw new InvalidArgumentException(
                'The captcha name must be different from "' . Captcha::CAPTCHA_NAME . '".'
            );
        }

        return array_combine(['id', 'name'], [$name, $name]);
    }

    /**
     * Check attributes.
     * @author ARCANEDEV
     */
    private function checkAttributes()
    {
        $this->checkTypeAttribute();
        $this->checkThemeAttribute();
        $this->checkSizeAttribute();
    }

    /**
     * Check type attribute.
     * @author ARCANEDEV
     */
    private function checkTypeAttribute()
    {
        $this->checkDataAttribute(self::ATTR_TYPE, 'image', ['image', 'audio']);
    }

    /**
     * Check theme attribute.
     * @author ARCANEDEV
     */
    private function checkThemeAttribute()
    {
        $this->checkDataAttribute(self::ATTR_THEME, 'light', ['light', 'dark']);
    }

    /**
     * Check size attribute.
     * @author ARCANEDEV
     */
    private function checkSizeAttribute()
    {
        $this->checkDataAttribute(self::ATTR_SIZE, 'normal', ['normal', 'compact']);
    }

    /**
     * Check data Attribute.
     *
     * @param  string $name
     * @param  string $default
     * @param  array $available
     * @author ARCANEDEV
     */
    private function checkDataAttribute($name, $default, array $available)
    {
        $item = $this->getItem($name);

        if (!empty($item)) {
            $item = (is_string($item) && in_array($item, $available)) ? strtolower(trim($item)) : $default;

            $this->setItem($name, $item);
        }
    }

    /**
     * Check if has an item.
     *
     * @param  string $name
     *
     * @return bool
     * @author ARCANEDEV
     */
    private function hasItem($name)
    {
        return array_key_exists($name, $this->items);
    }
}
