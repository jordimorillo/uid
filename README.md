# Unique Identifiers for PHP
The goal for this package is to provide a solution to those who need a simple way to create unique identifiers that can also be used as primary key for relational databases.

The basis idea was to have something similar to Snowflake identifiers that doesn't depend on redis or any other cache system with workers to generate the identifiers.

The Identifier is developed as a StringValueObject so it will be casted as a string if needed.

The formula is:

UniqueId = `php-object-identifier` + `random-integer` + `microtime`

To this identifier gets repeated it should coincide the object identifier, the microtime, and a 7 number random integer. That is really very improbable.

I made a test to check how often this can happen, but until now I've not found any case.

```php
<?php

use JordiMorillo\Uid;

class MyProductId extends Uid {}

$myProductId = new MyProductId();

echo "$myProductId"; //This should cast the identifier as an integer

$myProductIdString = $myProductId->toString();

$anotherProductId = new MyProductId($myProductIdString); //This should be a similar equal as $myProductId
```

