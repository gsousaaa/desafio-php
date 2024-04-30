<?php

namespace Chuva\Php\WebScrapping;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Exception;

class Spreadsheet
{
    public function createSpreadsheet(array $papers): void
    {
        try {
            $filePath = __DIR__ . '/../../assets/output.xlsx';
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile($filePath);

            $headerCells = [
                'ID',
                'Title',
                'Type',
                'Author 1',
                'Author 1 Institution',
                'Author 2',
                'Author 2 Institution',
                'Author 3',
                'Author 3 Institution',
                'Author 4',
                'Author 4 Institution',
                'Author 5',
                'Author 5 Institution',
                'Author 6',
                'Author 6 Institution',
                'Author 7',
                'Author 7 Institution',
                'Author 8',
                'Author 8 Institution',
                'Author 9',
                'Author 9 Institution',
            ];

            $headerRow = WriterEntityFactory::createRowFromArray($headerCells);
            $writer->addRow($headerRow);

            $style = (new StyleBuilder())
                ->setFontBold()
                ->setFontName('Arial')
                ->setFontSize(10)
                ->setCellAlignment(CellAlignment::LEFT)
                ->build();

            foreach ($papers as $paper) {
                $valueCells = [];
                $valueCells[] = $paper->id;
                $valueCells[] = $paper->title;
                $valueCells[] = $paper->type;

                foreach ($paper->authors as $author) {
                    //Removendo o ';' do da string
                    $valueCells[] = str_replace(';', '', $author->name);
                    $valueCells[] = $author->institution;
                }

                $valueRow = WriterEntityFactory::createRowFromArray($valueCells, $style);

                $writer->addRow($valueRow);
            }

            $writer->close();
            print_r("Planilha criada com sucesso");
        } catch (Exception $e) {
            print_r("Ocorreu um erro" . $e->getMessage());
        }
    }
}

