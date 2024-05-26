<?php
/**
 * "license-data package"
 * Copyright (c) 2013, Tim Otten
 * License: BSD-2-Clause
 */
namespace LicenseData;

class License {
    private $name;
    private $title;
    private $txtPath;
    private $url;

    public function __construct($name, $title, $txtPath, $url = NULL) {
        $this->name = $name;
        $this->title = $title;
        $this->txtPath = $txtPath;
        $this->url = $url;
    }

    /**
     * @return string a code name (eg "GPL-2.0+")
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return string descriptive title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return string the full license text
     */
    public function getText() {
        return file_get_contents($this->txtPath);
    }

    /**
     * @return string public web URL for the license
     */
    public function getUrl() {
        return $this->url;
    }
}
