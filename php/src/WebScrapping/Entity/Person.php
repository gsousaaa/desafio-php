<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Paper Author personal information.
 */
class Person {

  /**
   * Person name.
   */
  public string $name;

  /**
   * Person institution.
   */
  public string $institution;

    /**
   * Person postId.
   */

   public $postId;

  /**
   * Builder.
   */

   
  public function __construct($name, $institution, $postId) {
    $this->name = $name;
    $this->institution = $institution;
    $this->postId = $postId;
  }

}
