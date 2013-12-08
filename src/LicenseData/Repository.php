<?php
namespace LicenseData;

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
     * @void
     */
    public function flush() {
        $this->index = NULL;
    }

    /**
     * @void
     */
    protected function load($file) {
        $this->index = array();
        if ($fh = fopen($file, 'r')) {
            while ($row = fgetcsv($fh)) {
                $this->index[$row[0]] = new License($row[0], $row[1], $row[2]);
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
            $this->load($this->basedir . DIRECTORY_SEPARATOR . 'index.csv');
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
