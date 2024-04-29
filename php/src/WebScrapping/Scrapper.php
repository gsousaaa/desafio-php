<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */



class Scrapper
{

  /**
   * Loads paper information from the HTML and returns the array with the Element.
   */
  public function scrap(\DOMDocument $dom): array
  {
    $xPATH = new \DOMXPath($dom);
    $papers = [];
    $authors = [];


    $titleElements = $xPATH->query('//*[@class="my-xs paper-title"]');
    $authorsElements = $xPATH->query('//*[@class="authors"]');
    $idElements = $xPATH->query(('//*[@class="volume-info"]'));
    $postTypeElements = $xPATH->query(('//*[@class="tags mr-sm"]'));

    foreach ($authorsElements as $authorElement) {
      foreach ($authorElement->getElementsByTagName('span') as $authorsSpan) {
        // Obtém o texto do atributo 'title' que contém informações sobre a universidade
        $authorInstitution = '';
        if ($authorsSpan->hasAttribute('title')) {
          $authorInstitution = $authorsSpan->getAttribute('title');
        }

        // Obtém o texto do conteúdo do 'span', que contém o nome do autor
        $authorName = trim($authorsSpan->textContent);

        // Cria uma nova instância de Person com o nome do autor e a universidade
        $author = new Person($authorName, $authorInstitution);

        // Adiciona o autor ao array de autores
        $authors[] = $author;
       
      }
    }

    return $papers;
  }




}









