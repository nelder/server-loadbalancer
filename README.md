#Server Load Balancer
*A basic PHP load balancing system.*

##Server Types
1. Load Balancer: redirect traffic between specified possible node servers.
2. Node: single application server.

##Load from Nodes
* To fetch load from a node, access the `webroot/load/system_load.php`
* Load system requires static authentication specified in `load/config.php`

**Sample Use:** note, server key would be required. 
```php
<?php 
$node_one = file_get_contents('node1.example.com/sys/system_load?k=SERVER_KEY_HERE');
?>
```

##Private Networking on DigitalOcean
