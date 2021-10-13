<?php


use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;

class Loader{

    private string $filename;
    private array $humans;

    public function __construct(string $filename)
    {
        $this->humans = [];
        $this->filename = $filename;
        $stream = fopen($filename, 'r');
        $csv = Reader::createFromStream($stream);
        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        $stmt = Statement::create();

        $records = $stmt->process($csv);



        foreach ($records as $key => $record) {
                $this->humans[$key] = new Human($record['name'], $record['surname'],$record['id'], $record['info']);
        }
        fclose($stream);

    }

    /**
     * @return array
     */
    public function getHumans(): array
    {
        return $this->humans;
    }


    public function Delete(int $key){
        array_splice($this->humans, $key-1, 1);

        $stream = fopen($this->filename, 'w');

        fputcsv($stream, ['name', 'surname', 'id', 'info'], ';');
        foreach ($this->humans as $item){
            fputcsv($stream, [$item->getName(), $item->getSurname(),$item->getId(), $item->getInfo()], ';');
        }
        fclose($stream);


    }

    public function addHuman(string $name,string $surname,string $id,string $info ){

        $this->humans[] = new Human($name, $surname, $id, $info);
        $stream = fopen($this->filename, 'w');

        fputcsv($stream, ['name', 'surname', 'id', 'info'], ';');
        foreach ($this->humans as $item){
            fputcsv($stream, [$item->getName(), $item->getSurname(),$item->getId(), $item->getInfo()], ';');
        }
        fclose($stream);
    }

    public function searchById(string $id){
        foreach ($this->humans as $human){
            if($human->getId() === $id){
                return $human;
            }
        }
        return 'Not Found';
    }


}