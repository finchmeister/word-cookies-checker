<?php


class LocalDictionary implements DictionaryInterface
{
    const DICTIONARY_SRC = '/usr/share/dict/words';

    protected $dictionary;

    public function __construct()
    {
        $this->dictionary = strtoupper(file_get_contents(self::DICTIONARY_SRC));
    }

    public function getWord($word): ?WordModel
    {
        if (preg_match('/^' . $word . '$/m', $this->dictionary)) {
            $wordModel = new WordModel();
            $wordModel
                ->setWord($word)
                ->setDefinition('~');
            return $wordModel;
        } else {
            return null;
        }
    }
}