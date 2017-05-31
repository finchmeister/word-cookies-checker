<?php


class PearsonDictionary implements DictionaryInterface
{

    public function makeApiRequest($word)
    {
        $url = "http://api.pearson.com/v2/dictionaries/entries?headword=$word&limit=1";
        try {
            $response = json_decode(file_get_contents($url));
            return $response;
        } catch (Exception $e) {
            echo "API Call Failed " . $e->getMessage() . "\n";
        }
        return null;
    }

    public function getWord($word): ?WordModel
    {
        $response = $this->makeApiRequest($word);
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