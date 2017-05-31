<?php


class ComboDictionary implements DictionaryInterface
{
    /** @var DictionaryInterface */
    protected $fastDictionary;

    /** @var DictionaryInterface */
    protected $detailedDictionary;

    function __construct(
        DictionaryInterface $fastDictionary,
        DictionaryInterface $detailedDictionary
    )
    {
        $this->fastDictionary = $fastDictionary;
        $this->detailedDictionary = $detailedDictionary;
    }

    public function getWord($word): ?WordModel
    {
        if ($wordModel = $this->fastDictionary->getWord($word)) {
            $detailedWord = $this->detailedDictionary->getWord($word);
            if ($detailedWord instanceof WordModel) {
                $wordModel->setDefinition($detailedWord->getDefinition());
                return $wordModel;
            }
        }
        return null;
    }
}