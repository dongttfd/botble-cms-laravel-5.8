<?php

namespace Botble\SeoHelper\Contracts;

use Botble\SeoHelper\Contracts\Entities\TwitterCardContract;

interface SeoTwitterContract extends RenderableContract
{
    /**
     * Set the twitter card instance.
     *
     * @param  \Botble\SeoHelper\Contracts\Entities\TwitterCardContract $card
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setCard(TwitterCardContract $card);

    /**
     * Set the card type.
     *
     * @param  string $type
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setType($type);

    /**
     * Set the card site.
     *
     * @param  string $site
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setSite($site);

    /**
     * Set the card title.
     *
     * @param  string $title
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setTitle($title);

    /**
     * Set the card description.
     *
     * @param  string $description
     *
     * @return self
     * @author ARCANEDEV
     */
    public function setDescription($description);

    /**
     * Add image to the card.
     *
     * @param  string $url
     *
     * @return self
     * @author ARCANEDEV
     */
    public function addImage($url);

    /**
     * Add many meta to the card.
     *
     * @param  array $meta
     *
     * @return self
     * @author ARCANEDEV
     */
    public function addMetas(array $meta);

    /**
     * Add a meta to the twitter card.
     *
     * @param  string $name
     * @param  string $content
     *
     * @return self
     * @author ARCANEDEV
     */
    public function addMeta($name, $content);
}
