<?php

namespace Data;

interface WebPageInterface{
    public function __construct(ThemeInterface $theme);
    public function getContent();
}