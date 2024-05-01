<?php

namespace Chuva\Tests\Unit\WebScrapping\WebScrapping\Entity;

use Chuva\Php\WebScrapping\Entity\Person;
use PHPUnit\Framework\TestCase;

/**
 * Tests requirements for Person.
 */
class PersonTest extends TestCase {

  /**
   * Tests construct().
   */
  public function testConstruct() {
    $person = new Person('Name', 'Institution', '1234');

    $this->assertEquals('Name', $person->name);
    $this->assertEquals('Institution', $person->institution);
    $this->assertEquals('1234', $person->postId);
  }

  /**
   * Tests construct() with empty institution.
   */
  public function testConstructNoInstitution() {
    $person = new Person('Name', '', '1234');

    $this->assertEquals('Name', $person->name);
    $this->assertEquals('', $person->institution);
    $this->assertEquals('1234', $person->postId);
  }

}

