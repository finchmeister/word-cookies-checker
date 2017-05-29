<?php


interface DictionaryInterface
{

    public function getWord($word): ?WordModel;

}