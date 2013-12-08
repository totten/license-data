<?php
namespace LicenseData;

class License {
    private $name;
    private $title;
    private $txtPath;

    public function __construct($name, $title, $txtPath) {
        $this->name = $name;
        $this->title = $title;
        $this->txtPath = $txtPath;
    }

    /**
     * @return string a code name (eg "GPL-2.0+")
     */
    function getName() {
        return $this->name;
    }

    /**
     * @return string descriptive title
     */
    function getTitle() {
        return $this->title;
    }

    /**
     * @retur string the full license text
     */
    function getText() {
        return file_get_contents($this->txtPath);
    }
}
