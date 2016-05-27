<?php
include 'TinySegmenterPHP.php';
error_reporting( error_reporting() & ~E_NOTICE );

$inFile = 'in.txt';

$s = 'echo は実際には関数ではありません (言語構造です)。このため、使用する際に括弧は必要ありません。 (いくつかの他の言語構造と異なり) echo は関数のように動作しません。そのため、 関数のコンテキスト中では常に使用することができません。 加えて、複数のパラメータを指定して echo をコールしたい場合、括弧の中にパラメータを記述してはいけません。';
$s = 'echoは実際には関数ではありません(言語構造です)。このため、使用する際に括弧は必要ありません。(いくつかの他の言語構造と異なり)echoは関数のように動作しません。そのため、関数のコンテキスト中では常に使用することができません。加えて、複数のパラメータを指定してechoをコールしたい場合、括弧の中にパラメータを記述してはいけません。';
$s = file_get_contents($inFile);

$t = new TinySegmenter($s);
$segment = $t->segment();

//var_dump($segment); // gets segmented list of words.
foreach ($segment as $word) {
  echo "$word\n";
}
?>