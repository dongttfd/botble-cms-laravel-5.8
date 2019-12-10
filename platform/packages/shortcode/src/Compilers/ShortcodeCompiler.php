<?php

namespace Botble\Shortcode\Compilers;

use Illuminate\Support\Str;

class ShortcodeCompiler
{

    /**
     * Enabled state
     *
     * @var boolean
     */
    protected $enabled = false;

    /**
     * Enable strip state
     *
     * @var boolean
     */
    protected $strip = false;

    /**
     * @var mixed
     */
    protected $matches;

    /**
     * Registered shortcode
     *
     * @var array
     */
    protected $registered = [];

    /**
     * Enable
     *
     * @return void
     * @author Asif Iqbal
     * @since 2.1
     */
    public function enable()
    {
        $this->enabled = true;
    }

    /**
     * Disable
     *
     * @return void
     * @author Asif Iqbal
     * @since 2.1
     */
    public function disable()
    {
        $this->enabled = false;
    }

    /**
     * Add a new shortcode
     *
     * @param $key
     * @param $name
     * @param null $description
     * @param callable|string $callback
     * @author Asif Iqbal
     * @since 2.1
     */
    public function add($key, $name, $description = null, $callback)
    {
        $this->registered[$key] = compact('key', 'name', 'description', 'callback');
    }

    /**
     * Compile the contents
     *
     * @param  string $value
     * @return string
     * @author Asif Iqbal
     * @since 2.1
     */
    public function compile($value)
    {
        // Only continue is shortcode have been registered
        if (!$this->enabled || !$this->hasShortcodes()) {
            return $value;
        }
        // Set empty result
        $result = '';
        // Here we will loop through all of the tokens returned by the Zend lexer and
        // parse each one into the corresponding valid PHP. We will then have this
        // template as the correctly rendered PHP that can be rendered natively.
        foreach (token_get_all($value) as $token) {
            $result .= is_array($token) ? $this->parseToken($token) : $token;
        }

        return $result;
    }

    /**
     * Check if shortcode have been registered
     *
     * @return boolean
     * @author Asif Iqbal
     * @since 2.1
     */
    public function hasShortcodes()
    {
        return !empty($this->registered);
    }

    /**
     * Parse the tokens from the template.
     *
     * @param  array $token
     * @return string
     * @author Asif Iqbal
     * @since 2.1
     */
    protected function parseToken($token)
    {
        list($id, $content) = $token;
        if ($id == T_INLINE_HTML) {
            $content = $this->renderShortcodes($content);
        }

        return $content;
    }

    /**
     * Render shortcode
     *
     * @param  string $value
     * @return string
     * @author Asif Iqbal
     * @since 2.1
     */
    protected function renderShortcodes($value)
    {
        $pattern = $this->getRegex();

        return preg_replace_callback('/' . $pattern . '/s', [$this, 'render'], $value);
    }

    /**
     * Render the current called shortcode.
     *
     * @param  array $matches
     * @return string
     * @author Asif Iqbal
     * @since 2.1
     */
    public function render($matches)
    {
        // Compile the shortcode
        $compiled = $this->compileShortcode($matches);
        $name = $compiled->getName();

        // Render the shortcode through the callback
        return call_user_func_array($this->getCallback($name), [
            $compiled,
            $compiled->getContent(),
            $this,
            $name,
        ]);
    }

    /**
     * Get Compiled Attributes.
     *
     * @param $matches
     * @return mixed
     * @author Asif Iqbal
     * @since 2.1
     */
    protected function compileShortcode($matches)
    {
        // Set matches
        $this->setMatches($matches);
        // pars the attributes
        $attributes = $this->parseAttributes($this->matches[3]);

        // return shortcode instance
        return new Shortcode(
            $this->getName(),
            $attributes,
            $this->getContent()
        );
    }

    /**
     * Set the matches
     *
     * @param array $matches
     * @author Asif Iqbal
     * @since 2.1
     */
    protected function setMatches($matches = [])
    {
        $this->matches = $matches;
    }

    /**
     * Return the shortcode name
     *
     * @return string
     * @author Asif Iqbal
     * @since 2.1
     */
    public function getName()
    {
        return $this->matches[2];
    }

    /**
     * Return the shortcode content
     *
     * @return string
     * @author Asif Iqbal
     * @since 2.1
     */
    public function getContent()
    {
        // Compile the content, to support nested shortcode
        return $this->compile($this->matches[5]);
    }

    /**
     * Get the callback for the current shortcode (class or callback)
     *
     * @param  string $key
     * @return callable|array
     * @author Asif Iqbal
     * @since 2.1
     */
    public function getCallback($key)
    {
        // Get the callback from the shortcode array
        $callback = $this->registered[$key]['callback'];
        // if is a string
        if (is_string($callback)) {
            // Parse the callback
            list($class, $method) = Str::parseCallback($callback, 'register');
            // If the class exist
            if (class_exists($class)) {
                // return class and method
                return [
                    app($class),
                    $method,
                ];
            }
        }

        return $callback;
    }

    /**
     * Parse the shortcode attributes
     * @param $text
     * @author Wordpress
     * @return array
     * @modified Asif Iqbal
     * @since 2.1
     */
    protected function parseAttributes($text)
    {
        $attributes = [];
        // attributes pattern
        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        // Match
        if (preg_match_all($pattern, preg_replace('/[\x{00a0}\x{200b}]+/u', ' ', $text), $match, PREG_SET_ORDER)) {
            foreach ($match as $m) {
                if (!empty($m[1])) {
                    $attributes[strtolower($m[1])] = str_replace('&quot;', '', stripcslashes($m[2]));
                } elseif (!empty($m[3])) {
                    $attributes[strtolower($m[3])] = str_replace('&quot;', '', stripcslashes($m[4]));
                } elseif (!empty($m[5])) {
                    $attributes[strtolower($m[5])] = str_replace('&quot;', '', stripcslashes($m[6]));
                } elseif (isset($m[7]) && strlen($m[7])) {
                    $attributes[] = str_replace('&quot;', '', stripcslashes($m[7]));
                } elseif (isset($m[8])) {
                    $attributes[] = str_replace('&quot;', '', stripcslashes($m[8]));
                }
            }
        } else {
            $attributes = ltrim($text);
        }
        // return attributes
        return is_array($attributes) ? $attributes : [$attributes];
    }

    /**
     * Get shortcode names
     *
     * @return string
     * @author Asif Iqbal
     * @since 2.1
     */
    public function getShortcodeNames()
    {
        return join('|', array_map('preg_quote', array_keys($this->registered)));
    }

    /**
     * Get shortcode regex.
     *
     * @author Wordpress
     * @return string
     * @modified Asif Iqbal
     * @since 2.1
     */
    protected function getRegex()
    {
        $name = $this->getShortcodeNames();

        return '\\[(\\[?)(' . $name . ')(?![\\w-])([^\\]\\/]*(?:\\/(?!\\])[^\\]\\/]*)*?)(?:(\\/)\\]|\\](?:([^\\[]*+(?:\\[(?!\\/\\2\\])[^\\[]*+)*+)\\[\\/\\2\\])?)(\\]?)';
    }

    /**
     * Remove all shortcode tags from the given content.
     *
     * @param string $content Content to remove shortcode tags.
     * @return string Content without shortcode tags.
     * @author Asif Iqbal
     * @since 2.1
     */
    public function strip($content)
    {
        if (empty($this->registered)) {
            return $content;
        }
        $pattern = $this->getRegex();

        return preg_replace_callback('/' . $pattern . '/s', [$this, 'stripTag'], $content);
    }

    /**
     * @return mixed
     * @author Asif Iqbal
     * @since 2.1
     */
    public function getStrip()
    {
        return $this->strip;
    }

    /**
     * @param boolean $strip
     * @author Asif Iqbal
     * @since 2.1
     */
    public function setStrip($strip)
    {
        $this->strip = $strip;
    }

    /**
     * Remove shortcode tag
     *
     * @param string $match
     * @return string Content without shortcode tag.
     * @author Asif Iqbal
     * @since 2.1
     */
    protected function stripTag($match)
    {
        if ($match[1] == '[' && $match[6] == ']') {
            return substr($match[0], 1, -1);
        }

        return $match[1] . $match[6];
    }

    /**
     * @return array
     * 
     */
    public function getRegistered()
    {
        return $this->registered;
    }

    /**
     * @param $key
     * @param $html
     */
    public function setAdminConfig($key, $html)
    {
        $this->registered[$key]['admin_config'] = $html;
    }
}
