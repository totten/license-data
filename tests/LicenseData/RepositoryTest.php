<?php
/**
 * "license-data package"
 * Copyright (c) 2013, Tim Otten
 * License: BSD-2-Clause
 */
namespace LicenseData;

class RepositoryTest extends \PHPUnit_Framework_TestCase {
    var $oldCwd;

    function setUp() {
      parent::setUp();

      // Don't assume CWD==license-data dir
      $this->oldCwd = getcwd();
      chdir(dirname(getcwd())); // don't care where, just somewhere else
    }

    function tearDown() {
        chdir($this->oldCwd);
    }

    function testValidReferences() {
        $licenses = new \LicenseData\Repository();
        $all = $licenses->getAll();
        $this->assertTrue(count($all) > 1);
        foreach ($all as $key => $license) {
            $this->assertEquals($key, $license->getName());
            $this->assertTrue(self::notEmpty($license->getName()));
            $this->assertTrue(self::notEmpty($license->getTitle()));
            $this->assertTrue(self::notEmpty($license->getText()));
            $this->assertTrue(self::notEmpty($license->getUrl()));
        }
    }

    function testByName() {
        $licenses = new \LicenseData\Repository();
        $this->assertEquals('GNU Lesser General Public License v2.1 or later', $licenses->get('LGPL-2.1+')->getTitle());
        $this->assertEquals('https://www.gnu.org/licenses/lgpl-2.1.html', $licenses->get('LGPL-2.1+')->getUrl());
    }

    function notEmpty($x) {
      return !empty($x);
    }
}
