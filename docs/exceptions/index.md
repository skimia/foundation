---
title: Exceptions
---
Le composant Exceptions fournit un ensemble d'exceptions et de helpers pour faciliter les tests et la gestion des erreurs

## Exceptions

* IsNotASubclassOfException //todo
* InvalidSuperclassUsedForTraitException //todo

## Helpers


### Fails functions

fournis une implementation des fonctions php (natives ou non) avec envois d'exceptions automatiquement lorsque la fonction ou le test échoue



#### is_subclass_of_or_fail

Vérifie que la classe `$object` est bien une classe enfante de `$class_name` ou envoie une exception de Type
`IsNotASubclassOfException`
```php
		bool is_subclass_of_or_fail ( mixed $object , string $class_name [, bool $allow_string = TRUE ] )
```

#### ensure_trait_used_in_subclass_of_or_fail

Vérifie que le trait `$trait` est bien utilisé dans une classe `$object` qui est enfant de `$class_name` ou envoie une exception de Type
`InvalidSuperclassUsedForTraitException`
```php
		bool ensure_trait_used_in_subclass_of_or_fail (string $trait, mixed $object , string $class_name [, bool $allow_string = TRUE ] )
```
