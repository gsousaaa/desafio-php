<?php

namespace Chuva\Php\WebScrapping;

/**
 * Runner for the Webscrapping exercice.
 */
class Main {

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
    $html = file_get_contents(__DIR__.'/../../assets/origin.html');
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTML($html);

    $data = (new Scrapper())->scrap($dom);
    $spreadsheet = new Spreadsheet();

    // Write your logic to save the output file bellow.
     $spreadsheet->createSpreadsheet($data);
  }
}
