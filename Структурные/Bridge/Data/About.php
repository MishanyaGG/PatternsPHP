<?php

namespace Data;

class About implements WebPageInterface{
    protected $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }

    public function getContent()
    {
        return "Aout page in ". $this->theme->getColor();
    }
}