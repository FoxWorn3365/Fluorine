# Fluorine
Speed up your development time with **Fluorine**: manage strings, arrays and objects quickly and in just a few lines!<br>
### PHP Vanilla
```php
<?php
$array = [
  "foxworn3365",
  "paolo bonolis",
  "barbara d'urso",
  "jerry scotty",
  "pogiolo"
];

sort($array);

foreach ($array as $value) {
  // ..
}
```
---
### Fluorine
```php
<?php
new NextArray([
  "foxworn3365",
  "paolo bonolis",
  "barbara d'urso",
  "jerry scotty",
  "pogiolo"
])->sort()->foreach($value) {
  // ..
});
```
### Everything in <ins>a few lines</ins>: **connected**, *simple* and `optimized`
Thanks to **Fluorine** you can save up to 15% of Ram in medium and large projects!<br>

## Why Fluorine is so ⚡fast?
Objects consume less memory than arrays (associative or otherwise): that's why **Fluorine** bases everything on objects!<br>
Don't believe it? This is how an array is handled:
```php
\Fluorine\ClearObjet(): {
  "0":"value1",
  "1":"value2",
  "2":"value3"
}
```

## Installation
You can safely use composer to install this library:
```
composer require foxworn3365/fluorine
```
