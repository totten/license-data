<?php
/**
 * "license-data package"
 * Copyright (c) 2013, Tim Otten
 * License: BSD-2-Clause
 */
namespace LicenseData;

class RepositoryTest extends \PHPUnit_Framework_TestCase {
    function testValidReferences() {
        $licenses = new \LicenseData\Repository();
        $all = $licenses->getAll();
        $this->assertTrue(count($all) > 1);
        foreach ($all as $key => $license) {
            $this->assertEquals($key, $license->getName());
            $this->assertTrue(self::notEmpty($license->getName()));
            $this->assertTrue(self::notEmpty($license->getTitle()));
            $this->assertTrue(self::notEmpty($license->getText()));
        }
    }

    function testByName() {
        $licenses = new \LicenseData\Repository();
        $this->assertEquals('GNU Lesser General Public License v2.1 or later', $licenses->get('LGPL-2.1+')->getTitle());
    }

    function notEmpty($x) {
      return !empty($x);
    }
}