<?php
  require_once __DIR__ . '/vendor/autoload.php';
  use ETH\Monitor;

  $monitor = new Monitor([
    'node' => 'https://ropsten.infura.io',
    'network' => 'ropsten',
    'blockConfirm' => 7,
    'txLostTimeout' => 15, // minutes
    'intervalRefetchTx' => 10, // seconds
  ]);

  // swap
  $tx = '0xe763ffe95d02e231f1d7450a0848b588447c8bf604953077fefc1eef369e901e';
  // transfer Token
  $tx = '0xd910078d3c2630acfdf15c0f72b09d0808639fcc5323ea6fe054e9444f90525d';
  // transfer ETH
  $tx = '0x253f8e00104738fca9869010ebf78218ae4d2c40be4d48d0b85b13a8971b4cb6';

  // Pay Token -> ETH
  $tx = '0x7b87463a7747158aedbe3ce644b2410370bb6ba0a888690e0608b63e5125c75c';
  $tx = '0xd7f64ca7290669d9eb9357ed62b32dc93908fd2b688003d681675d28e22710d9';
  // Pay ETH -> ETH
  $tx = '0x8715d6e98a0a68ad22574be7ef1a0ffecb00149b1e69767c8e1c9ce4e0a1610b';
  // Pay Token -> Token
  $tx = '0x2d6a76327b0212028f584e5d831e8ece3f0491c47b965485f517a6c114490fa3';
  // Pay ETH -> Token
  $tx = '0xda023ae54d8a110f5f7eb002080edeeddb1d78d6de41cf46d37e3b631b56b01b';

  var_dump($monitor->checkStatus($tx));
  die();