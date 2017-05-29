<?php


class WordModel
{

    /**
     * @var string
     */
    protected $word;

    /**
     * @var string
     */
    protected $definition;

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @param string $word
     * @return WordModel
     */
    public function setWord($word)
    {
        $this->word = $word;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param string $definition
     * @return WordModel
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
        return $this;
    }



}