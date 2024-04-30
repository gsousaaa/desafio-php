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
    $authorsByPostId = [];


    $titleElements = $xPATH->query('//*[@class="my-xs paper-title"]');
    $authorsElements = $xPATH->query('//*[@class="authors"]');
    $idElements = $xPATH->query(('//*[@class="volume-info"]'));
    $postTypeElements = $xPATH->query(('//*[@class="tags mr-sm"]'));
   
    for ($i = 0; $i < $idElements->length; $i++) {
      $postId = $idElements->item($i)->textContent;
      $title = $titleElements->item($i)->textContent;
      $type = $postTypeElements->item($i)->textContent;

      //verifica se o PostId já existe no array, se não, cria um novo array vazio
      if (!isset($authorsByPostId[$postId])) {
        $authorsByPostId[$postId] = [];
    }


      foreach ($authorsElements->item($i)->getElementsByTagName('span') as $authorsSpan) {
        $authorInstitution = '';
        if ($authorsSpan->hasAttribute('title')) {
          $authorInstitution = $authorsSpan->getAttribute('title');
        }

        $authorName = trim($authorsSpan->textContent);

        $author = new Person($authorName, $authorInstitution, $postId);

        if ($author->postId !== $postId) {
          throw new \Exception('O autor não pertence a esse POST');
        }

        // Adiciona o autor correspondente a chave do array associativo, usando postId como chave
        $authorsByPostId[$postId][] = $author;

      }

      $papers[] = new Paper($postId, $title, $type, $authorsByPostId[$postId]);

    }
    return array_filter($papers);
  }




}









