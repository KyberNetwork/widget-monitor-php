# Monitor Kyber Transaction (Swap / Widget)

## Install
Install monitor-tx using npm:

```console
$ composer require tranbaohuy/monitor-eth-tx
```

## Usage

```php
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

$tx = '0xda023ae54d8a110f5f7eb002080edeeddb1d78d6de41cf46d37e3b631b56b01b';
$data = $monitor->checkStatus($tx);

```
Currently, the following options are supported.

|     Field               |   Value    |      Detail                                                        |
|-------------------------|------------|--------------------------------------------------------------------|
|     node                |     String |    URL of node                                                     |
|     network             |     String |    Ethereum network                                                |
|     blockConfirm        |     Number |    Number of block confirmation                                    |
|     txLostTimeout       |     Number |    Time until declare a tx is lost                                 |
|     intervalRefetchTx   |     Number |    Tx will be re-check after the time until data gotten            |

Default values:
```
  'node' => 'https://ropsten.infura.io',
  'network' => 'ropsten',
  'blockConfirm' => 7,
  'txLostTimeout' => 15, // minutes
  'intervalRefetchTx' => 5, // seconds
```

#### Response data

```php
[
  "status" => "SUCCESS",  // "FAIL" , "LOST"
  "from" => [
    "address" => "0xeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee",
    "decimal" => 18,
    "symbol" => "ETH",
    "amount" => "0.00162",
  ],
  "to" => [
    "address" => "0x4e470dc7321e84ca96fcaedd0c8abcebbaeb68c6",
    "decimal"=> 18,
    "symbol" => "KNC",
    "amount" => "0.6",
  ],
  "sentAddress" => "0x8d61ab7571b117644a52240456df66ef846cd999",
  "receivedAddress" => "0x63b42a7662538a1da732488c252433313396eade",
  "timestamp" => 1539243951,
  "type" => "pay",  // "transfer" , "trade"
]
```
