<?php


class PearsonDictionary implements DictionaryInterface
{

    protected $responseJson = '';

    public function getWord($word): ?WordModel
    {
        $url = "http://api.pearson.com/v2/dictionaries/entries?headword=$word&limit=1";
        try {
            $response = json_decode(file_get_contents($url));
        } catch (Exception $e) {
            echo "API Call Failed " . $e->getMessage() . "\n";
        }
        $this->responseJson = json_encode($response, JSON_PRETTY_PRINT);
        if (empty($response->results)) {
            return null;
        }
        $definition = $response->results[0]->senses[0]->definition ?? '~';
        if (is_array($definition)) {
            $definition = $definition[0];
        }
        $wordModel = new WordModel();
        $wordModel
            ->setWord($word)
            ->setDefinition($definition);
        return $wordModel;
    }
}