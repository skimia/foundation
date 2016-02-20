---
title: testing
---
Le composant testing fournit un ensemble de fonctionnalitées pour faciliter les tests.



## Testing Moked Commands

pour executer une commande `moked` depuis les tests, inclure l'utilisation du trait `Skimia\Foundation\Testing\Traits\CommandTrait` 
sur le `TestCase` charger de tester la commande `moked`, il definit :

#### Methode invokeCommand

```php
/**
 * @param \Illuminate\Console\Command $mockedCommandObject
 * @param array $arguments
 * @return int
 */
public function invokeCommand(Command $mockedCommandObject, $arguments = []);
```
permet d'initialiser la commande avec un mode de sortie pour logger l'affichage console



#### Methode getCommandOutput

```php
/**
 * @return Skimia\Foundation\Testing\CommandOutput
 */
public function getCommandOutput();
```

retourne le logger d'affiche console qui via sa methode `getOutputs()` permet de récuperer sous forme d'array la liste des lignes affichées durant les tests de la commande `moked`
> il doit être réinitialisé a la main si l'on souhaite, sinon dans le cas ou plusieurs appels à `invokeCommand` sont executées dans la même `TestCase` le logger contiendra l'ensemble de tous les retours console des commandes exécutées

exemple de retour :
```
array:5 [
    0 => "<comment>Regeneration of assets collections...</comment>"
    1 => "<comment>added collections : jquery, angularjs, js-stack</comment>"
    2 => "<ask>Update Assets groups with the new or removed collections ? y/n</ask>"
    3 => "<comment>sorry in the new release ;)</comment>"
    4 => "<comment>done</comment>"
  ]

```

#### Methode cleanOutputAndInvokeCommand

```php
/**
 * @param \Illuminate\Console\Command $mockedCommandObject
 * @param array $arguments
 * @return int
 */
public function cleanOutputAndInvokeCommand(Command $mockedCommandObject, $arguments = []);
```

identique à `invokeCommand` hormis le fait qu'elle clean le log des retours console.

#### Methode invokeCommandWithPrompt


dans le cas ou la commande utilise des questions via la methode `ask()` il faut travailler notre commande pour que lors des test 
le logger soit appelé et les question "nextées".

```php
/**
 * @param TestablePromptCommandInterface $commandObject
 * @param array $arguments
 * @return int
 */
public function invokeCommandWithPrompt(TestablePromptCommandInterface $commandObject, $arguments = [])
```

identique à `invokeCommand` dans l'utilisation mais nécessite de lui passer en paramètre une commande utilisant l'interface `Skimia\Foundation\Testing\TestablePromptCommandInterface`
elle peut être implémentée grâce au trait `Skimia\Foundation\Testing\Traits\TestableCommandTrait`

il permet dans le cas ou un ConsoleOutput est utilisé de ne pas executer le comportement de base des methodes `ask` et retourne directement après avoir loggé la question, de retourner la valeur par defaut.
> cependant Attention au cas ou une valeur par defaut est nulle, la valeur de retour sera forcée a NULL même si la validation est configurée pour forcer l'utilisateur a entrer une valeur.



### Exemple de methode de test

```php
public function testCommand(){


    $scannerMock = Mockery::mock(Scanner::class.'[getScannedPath]',[app()])->shouldAllowMockingProtectedMethods();

    $scannerMock->shouldReceive('getScannedPath')->atLeast()->times(1)->andReturn($this->getGeneratedFilePath());

    $commandMock = Mockery::mock(DumpCollectionsCommand::class.'[getScanner,getDirectories]')->shouldAllowMockingProtectedMethods();

    $commandMock->shouldReceive('getScanner')->atLeast()->times(1)->andReturn($scannerMock);
    $commandMock->shouldReceive('getDirectories')->atLeast()->times(1)->andReturn($this->getDirectories());

    $this->invokeCommandWithPrompt($commandMock);

    //est vrai si la chaine pasée est orésente dans une au moins des lignes retournées
    $this->assertTrue($this->getCommandOutput()->contains('angularjs'));
    
    //verifie si la question a été posée
    $this->assertTrue($this->getCommandOutput()->contains('<ask>Update Assets'));

    $this->assertTrue(File::exists($this->getGeneratedFilePath()));

    require $this->getGeneratedFilePath();

    $this->assertArrayHasKey('js-stack',Assets::group('default')->getCollections());


    File::delete($this->getGeneratedFilePath());
}
```