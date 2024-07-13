Leverage real-time data and advanced algorithms to calculate prices bases on the user's location with Autoprice.

<h1>Requirements</h1>
Please obtain Api Key from <a href="https://www.ip2location.io/">IP2LOCATION.IO</a>

<h1>Installation</h1>

``` 
composer require thealgoslingers/autoprice
```

<h1>Usage</h1>

```
<?php
require 'vendor/autoload.php';

use thealgoslingers\AutoPrice;

// Usage example
$api_key = 'your_api_key_here'; // api key from ip2location.io

// the default base price is approximately
// or same as 1 USD. So we assume price is 
// being converted from USD 
$base_price = 100.0;//base price to be converted from

$dp = new AutoPrice($api_key, $base_price);
$user_ip = '8.8.8.8';// ip of the user 

echo $dp->calculatePrice($user_ip);

```
