# Json 操作简单封装

```php
$a = json_manage()->decode('{"www":"cas"}',false);
var_dump($a);


$b = json_manage()->encode($a);
var_dump($b);
```