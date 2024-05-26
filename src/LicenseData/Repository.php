<?php
/**
 * "license-data package"
 * Copyright (c) 2013, Tim Otten
 * License: BSD-2-Clause
 */
namespace LicenseData;

use Exception;

class Repository {
    private $basedir;

    private $index;

    /**
     * @param string $basedir The source tree for the dataset
     */
    public function __construct($basedir = NULL) {
        if ($basedir === NULL) {
            $basedir = dirname(dirname(__DIR__));
        }
        $this->basedir = $basedir;
        $this->flush();
    }

    /**
     * Reset any cached data
     *
     * @void
     */
    public function flush() {
        $this->index = NULL;
    }

    /**
     * @return string path to the index file
     */
    public function getIndexFile() {
      return $this->basedir . DIRECTORY_SEPARATOR . 'index.csv';
    }

    /**
     * Read the index file
     *
     * @param string $file path to the index file
     * @void
     */
    protected function load($file) {
        $this->index = array();
        if ($fh = fopen($file, 'r')) {
            while ($row = fgetcsv($fh)) {
                $this->index[$row[0]] = new License($row[0], $row[1], $this->basedir . DIRECTORY_SEPARATOR . $row[2], $row[3]);
            }
            fclose($fh);
        } else {
           throw new Exception("Failed to open index.csv");
        }
    }

    /**
     * @return array of License
     */
    public function getAll() {
        if ($this->index === NULL) {
            $this->load($this->getIndexFile());
        }
        return $this->index;
    }

    /**
     * @param string $name a code name (eg "GPL-2.0+")
     * @return License|NULL
     */
    public function get($name) {
        $all = $this->getAll();
        return isset($all[$name]) ? $all[$name] : NULL;
    }
}
