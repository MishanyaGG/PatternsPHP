<?php

namespace Data;

class Careers implements WebPageInterface{
    protected $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "Careers page in ". $this->theme->getColor();
    }
}
