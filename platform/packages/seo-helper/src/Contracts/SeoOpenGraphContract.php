<?php

namespace Botble\SeoHelper\Contracts;

use Botble\SeoHelper\Contracts\Entities\OpenGraphContract;

interface SeoOpenGraphContract extends RenderableContract
{
    /**
     * Set the Open Graph instance.
     *
     * @param  \Botble\SeoHelper\Contracts\Entities\OpenGraphContract $openGraph
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setOpenGraph(OpenGraphContract $openGraph);

    /**
     * Set the open graph prefix.
     *
     * @param  string $prefix
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setPrefix($prefix);

    /**
     * Set type property.
     *
     * @param  string $type
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setType($type);

    /**
     * Set title property.
     *
     * @param  string $title
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setTitle($title);

    /**
     * Set description property.
     *
     * @param  string $description
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setDescription($description);

    /**
     * Set url property.
     *
     * @param  string $url
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setUrl($url);

    /**
     * Set image property.
     *
     * @param  string $image
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setImage($image);

    /**
     * Set site name property.
     *
     * @param  string $siteName
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setSiteName($siteName);

    /**
     * Add many open graph properties.
     *
     * @param  array $properties
     *
     * @return self
     * @author ARCANEDEV
     */
    public function addProperties(array $properties);

    /**
     * Add an open graph property.
     *
     * @param  string $property
     * @param  string $content
     *
     * @return self
     * @author ARCANEDEV
     */
    public function addProperty($property, $content);
}
