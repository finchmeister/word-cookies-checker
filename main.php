<?php

spl_autoload_register(function ($class_name) {
    include 'src/'. $class_name . '.php';
});

$start = microtime(1);
if (isset($argv[1])) {
    $line = $argv[1];
} else {
    echo "Enter your letters:\n";
    $line = trim(fgets(STDIN));
}

$letters = str_split(strtoupper($line));
sort($letters);
$permute = new Permute($letters);
$permutes = $permute->getPermutes();
$permutes = $permute->getAllPermutes();

echo $permute->getTotalCount() . " unique permutations\n";

$detailedDictionary = new PearsonDictionary();
$fastDictionary = new LocalDictionary();
$dictionary = new ComboDictionary(
    $fastDictionary,
    $detailedDictionary
);

$i = 0;
foreach ($permutes as $permuteI) {
    foreach ($permuteI as $word) {
        try {
            $wordModel = $dictionary->getWord($word);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($wordModel) {
            echo $wordModel->getWord() . ": " . $wordModel->getDefinition() . "\n";
            $i++;
        }
    }
}
$timeTaken = round(microtime(1) - $start, 2);
echo "Found {$i} words\n";
echo "Time taken: {$timeTaken}s\n";
