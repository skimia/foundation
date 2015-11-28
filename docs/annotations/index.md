---
title: Annotations
---
Le composant Annotation fournit les fonctionnalitées de scan d'annotation sur un projet laravel facilement et rapidement en utilisant 2 Classes et des Annotations

## L'annotation Scanner (Skimia\Foundation\Annotations\Scanner)

Se charge de scanner les classes et de générer le fichier de Scan (chargé de retranscrire les annotations scannées en equivalent php comprehensible par laravel ou le package utilisé)

### Créer un nouveau Scanner
pour cela il faut créer une nouvelle classe étandant du Scanner (Skimia\Foundation\Annotations\Scanner) pour la configuration, il faut définir certaines methodes a cette classe fraîchement crée.

#### Fichier de scan

configuration de l'emplacement du fichier de scan de préférence dans le dossier storage de l'application.
```php
      public function getScannedAnnotationPath()
	  {
		    return $this->app['path.storage'] . '/framework/api.routes.scanned.php';
	  }
```
#### Génération du fichier de scan

#### Chargement du fichier de scan




#### Annotation utilisée dan l'exemple
```php
        /**
         * @Annotation
         */
        class ApiResource {

            /**
             * The events the annotation hears.
             *
             * @var array
             */
            public $resourceEndPoint;

            /**
             * The api version.
             *
             * @var array
             */
            public $version;

            /**
             * The events the annotation hears.
             *
             * @var array
             */
            public $values;

            /**
             * Create a new annotation instance.
             *
             * @param  array $values
             *
             * @return void
             */
            public function __construct(array $values = [])
            {
                $this->resourceEndPoint = $values['value'];
                $this->version =  $values['version'];

                unset($values['value'],$values['version']);

                $this->values = (array) $values;
            }
        }
```
