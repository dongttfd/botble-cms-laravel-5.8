<?php

namespace Botble\SeoHelper\Entities\OpenGraph;

use Botble\SeoHelper\Contracts\Entities\OpenGraphContract;

class Graph implements OpenGraphContract
{
    /**
     * The Open Graph meta collection.
     *
     * @var \Botble\SeoHelper\Contracts\Entities\MetaCollectionContract
     */
    protected $meta;

    /**
     * Make Graph instance.
     * @author ARCANEDEV
     */
    public function __construct()
    {
        $this->meta = new MetaCollection;
    }

    /**
     * Set the open graph prefix.
     *
     * @param  string $prefix
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function setPrefix($prefix)
    {
        $this->meta->setPrefix($prefix);

        return $this;
    }

    /**
     * Set type property.
     *
     * @param  string $type
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function setType($type)
    {
        return $this->addProperty('type', $type);
    }

    /**
     * Set title property.
     *
     * @param  string $title
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function setTitle($title)
    {
        return $this->addProperty('title', $title);
    }

    /**
     * Set description property.
     *
     * @param  string $description
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function setDescription($description)
    {
        return $this->addProperty('description', $description);
    }

    /**
     * Set url property.
     *
     * @param  string $url
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function setUrl($url)
    {
        return $this->addProperty('url', $url);
    }

    /**
     * Set image property.
     *
     * @param  string $image
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function setImage($image)
    {
        return $this->addProperty('image', $image);
    }

    /**
     * Set site name property.
     *
     * @param  string $siteName
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function setSiteName($siteName)
    {
        return $this->addProperty('site_name', $siteName);
    }

    /**
     * Add many open graph properties.
     *
     * @param  array $properties
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function addProperties(array $properties)
    {
        $this->meta->addMany($properties);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @param  string $name
     * @param  string $content
     *
     * @return \Botble\SeoHelper\Entities\OpenGraph\Graph
     * @author ARCANEDEV
     */
    public function addProperty($name, $content)
    {
        $this->meta->add(compact('name', 'content'));

        return $this;
    }

    /**
     * Render the tag.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function render()
    {
        return $this->meta->render();
    }

    /**
     * Render the tag.
     *
     * @return string
     * @author ARCANEDEV
     */
    public function __toString()
    {
        return $this->render();
    }
}
