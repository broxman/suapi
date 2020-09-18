# ServiceUptime PHP Client Library

PHP Library for ServiceUptime API (https://www.serviceuptime.com/users/api-docs.php)


## Dependencies

PHP version >= 7 required.

The following PHP extensions are required:

* curl

## Install

Add ServiceUptime API to your `composer.json` file. 

```json
{
  "require": {
    "serviceuptime/api": "*"
  }
}
```

## Examples

### Initialize api 
```php
<?php
    $suapi = new \ServiceUptime\API\API('APIKEY');
?>
```

### Add new monitor to your ServiceUptime account
```php
<?php
    $monitor = $suapi->addMonitor([
		"Id" => "234342",
		"Name" => "domain.com",
		"CheckPeriod" => "5",
		"ServiceType" => "http",
		"Port" => "80",
		"HostName" => "domain.com",
		"HTTPAuthLogin" => "user1",
		"HTTPAuthPassword" => "pass123",
		"SendDefaultAlert" => "y",
		"SendAltAlert" => "domain.support@gmail.com;user.name@hotmail.com;tech@domain.com",
		"FailuresBeforeAlert" => "1",
		"SendDefaultSMS" => "n",
		"SendAltSMS" => "+11234567890;+10987654321",
		"FailuresBeforeSMS" => "3",
		"SendJabberAlert" => "n",
		"WebHookUrl" => "",
		"Timeout" => "15",
		"DownAlertSubject" => "Domain.com (http) is Down!",
		"UpAlertSubject" => "Domain.com (http) is Up!",
		"RepeatAlerts" => "0",
		"NoUpAlerts" => "n",
		"HighPriorityAlerts" => "y",
		"Enabled" => "y",
		"PublicStatAllowed" => "y",
		"HostPage" => "domain.com",
		"Status" => "active",
		"StatusMessage" => "Monitor is UP",
		"PubStatUrl" => "http://www.serviceuptime.com/users/uptimemonitoring.php?S=e4c9e21eb1222a4adb4a1da4cbc4a653&Id=234342",
		"LastCheckDate" => "2014-07-23 13:08:12",
		"LastCheckDateFormatted" => "34 sec. ago",
		"TotalChecks" => 909600,
		"TotalOutages" => 449,
		"TotalFailedChecks" => 921,
		"TotalUptime" => 99.899,
    ]);
    print_r($monitor);
?>
```

### Edit monitor information
```php
<?php
    $monitor = $suapi->updateMonitor([
    ]);
    print_r($monitor);
?>
```

### Remove monitor from your ServiceUptime account
```php
<?php
    $monitor = $suapi->deleteMonitor([
    ]);
    print_r($monitor);
?>
```

### Retrieve all your monitors information including uptime statistics summary and current status info
```php
<?php
    $monitor = $suapi->getMonitors([
    ]);
    print_r($monitor);
?>
```

### Retrieve detailed uptime report for your monitor
```php
<?php
    $monitor = $suapi->getReport([
    ]);
    print_r($monitor);
?>
```

### Retrieve one monitor information including uptime statistics summary and current status info
```php
<?php
    $monitor = $suapi->monitorInfo([
    ]);
    print_r($monitor);
?>
```

### Start monitoring for a paused monitor
```php
<?php
    $monitor = $suapi->startMonitor([
    ]);
    print_r($monitor);
?>
```

### Pause monitoring for a monitor
```php
<?php
    $monitor = $suapi->stopMonitor([
    ]);
    print_r($monitor);
?>
```

### Retrieve account information such as number of SMS credits, available monitors, default email alert, etc.
```php
<?php
    $monitor = $suapi->accountInfo([
    ]);
    print_r($monitor);
?>
```

## Documentation

 * [ServiceUptime Official documentation](https://www.serviceuptime.com/users/api-docs.php)

## License

[The MIT License (MIT)](LICENSE.txt)
