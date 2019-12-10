<?php

namespace Botble\SeoHelper;

use Botble\SeoHelper\Contracts\Entities\OpenGraphContract;
use Botble\SeoHelper\Contracts\SeoOpenGraphContract;

class SeoOpenGraph implements SeoOpenGraphContract
{

    /**
     * The Open Graph instance.
     *
     * @var \Botble\SeoHelper\Contracts\Entities\OpenGraphContract
     */
    protected $openGraph;

    /**
     * Make SeoOpenGraph instance.
     * @author ARCANEDEV
     */
    public function __construct()
    {
        $this->setOpenGraph(
            new Entities\OpenGraph\Graph()
        );
    }

    /**
     * Set the Open Graph instance.
     *
     * @param  \Botble\SeoHelper\Contracts\Entities\OpenGraphContract $openGraph
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setOpenGraph(OpenGraphContract $openGraph)
    {
        $this->openGraph = $openGraph;

        return $this;
    }

    /**
     * Set the open graph prefix.
     *
     * @param  string $prefix
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setPrefix($prefix)
    {
        $this->openGraph->setPrefix($prefix);

        return $this;
    }

    /**
     * Set type property.
     *
     * @param  string $type
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setType($type)
    {
        $this->openGraph->setType($type);

        return $this;
    }

    /**
     * Set title property.
     *
     * @param  string $title
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setTitle($title)
    {
        $this->openGraph->setTitle($title);

        return $this;
    }

    /**
     * Set description property.
     *
     * @param  string $description
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setDescription($description)
    {
        $this->openGraph->setDescription($description);

        return $this;
    }

    /**
     * Set url property.
     *
     * @param  string $url
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setUrl($url)
    {
        $this->openGraph->setUrl($url);

        return $this;
    }

    /**
     * Set image property.
     *
     * @param  string $image
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setImage($image)
    {
        $this->openGraph->setImage($image);

        return $this;
    }

    /**
     * Set site name property.
     *
     * @param  string $siteName
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function setSiteName($siteName)
    {
        $this->openGraph->setSiteName($siteName);

        return $this;
    }

    /**
     * Add many open graph properties.
     *
     * @param  array $properties
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function addProperties(array $properties)
    {
        $this->openGraph->addProperties($properties);

        return $this;
    }

    /**
     * Add an open graph property.
     *
     * @param  string $property
     * @param  string $content
     *
     * @return \Botble\SeoHelper\SeoOpenGraph
     * @author ARCANEDEV
     */
    public function addProperty($property, $content)
    {
        $this->openGraph->addProperty($property, $content);

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
        return $this->openGraph->render();
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
