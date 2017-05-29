<?php

spl_autoload_register(function ($class_name) {
    include 'src/'. $class_name . '.php';
});

echo "Enter your letters:\n";

$line = strtoupper(trim(fgets(STDIN)));

$letters = str_split($line);
sort($letters);
$permute = new Permute($letters);
$permutes = $permute->getPermutes();
$permutes = $permute->getAllPermutes();

echo $permute->getTotalCount() . " unique permutations\n";

$dictionary = new PearsonDictionary();

foreach ($permutes as $permuteI) {
    foreach ($permuteI as $word) {
        try {
            $wordModel = $dictionary->getWord($word);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($wordModel) {
            echo $wordModel->getWord() . ": " . $wordModel->getDefinition() . "\n";
        }
    }
}


