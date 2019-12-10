<?php

namespace Botble\SeoHelper\Entities;

use Botble\SeoHelper\Contracts\Entities\AnalyticsContract;

class Analytics implements AnalyticsContract
{
    /**
     * Google Analytics code.
     *
     * @var string
     */
    protected $google = '';

    /**
     * Set Google Analytics code.
     *
     * @param  string $code
     *
     * @return \Botble\SeoHelper\Entities\Analytics
     * @author ARCANEDEV
     */
    public function setGoogle($code)
    {
        $this->google = $code;

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
        return implode(PHP_EOL, array_filter([
            $this->renderGoogleScript(),
        ]));
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

    /**
     * Render the Google Analytics tracking script.
     *
     * @return string
     * @author ARCANEDEV
     */
    protected function renderGoogleScript()
    {
        if (empty($this->google)) {
            return '';
        }

        return <<<EOT
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', '$this->google', 'auto');
    ga('send', 'pageview');
</script>
EOT;
    }
}
