# Unique Integer Identifiers for PHP
The goal for this package is:

- To provide unique identifiers
- The identifiers will be integer so they can be used as primary keys in relational databases to keep performance
- Do not depend on third services to generate the Ids as happens with workers.

The current formula is:

UniqueId = `php-object-identifier` + `random-integer` + `microtime`

To this identifier gets repeated it should coincide the object identifier, the microtime, and a 7 number random integer. That is really very improbable.

Example of use:
```php
<?php

use JordiMorillo\Uid;

class MyProductId extends Uid {}

$myProductId = new MyProductId();

echo "$myProductId"; //This should cast the identifier as a string of numbers

$myProductIdString = $myProductId->toString();

$anotherProductId = new MyProductId($myProductIdString); //This should be a similar equal as $myProductId
```