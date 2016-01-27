---
title: Providers
---
Le composant providers fournit un ensemble de fonctionnalitées preconçues pour faciliter l'utilisation des ServicesProviders de laravel

## Traits

les traits utilisées ci desous utilisent le namespace `Skimia\Foundation\Providers\Traits`

### CommandLoaderTrait


#### Membres utilisées

* `$commands` de type `array` en clef la methode utilisée pour initiliser la commande sous la forme de `register{$clef}Command` et en clef l'alias de l'injecteur de dépendance

```php
protected $commands = [
    'Test' => 'package.cmd',
];
```

#### Methodes utilisées

* `registerCommands()` à appeler lors du register du service provider

```php
//mon service provider register method
public function register()
{
    $this->registerCommands();
}
```

* `register{$clef}Command` basé sur le membre `$commands` lie au service provider l'instance de la commande

```php
public function registerTestCommand()
{
    $this->app->singleton('package.cmd', function ($app) {
        return new Command();
    });
}
```