# **@Usdc** - PHP Universal Sql Database Connector

## Sommaire

1) [Introduction](#introduction)
2) [Installation](#installation)
3) [Utilisations](#utilisations)
    - [MySql](#mysql)
    - [SqLite3](#sqlite3)
    - [Postgres SQL](#postgres)
4) [Licence](#licence)
5) [A propos](#apropos)

<br>

<a name="introduction"></a>

## Introduction

Lorsque l'on veut créer un CMS, un moteur de traitement, ou tout simplement un site Web réutilisable de toute pièce, nous avons, la plus part du temps, besoin d'utiliser les bases de données.

Les plus connues reposent sur des serveurs ou moteur SQL auquel nous devons nous connecter avant d'interagir avec les données qu'ils contiennent.

Pour celà, PHP propose une extension nommée [PDO](https://www.php.net/manual/fr/book.pdo.php).

Cette extension requiert une chaine de connexion spécifique au serveur de données concerné, et certains attributs à son bon fonctionnement. C'est pourquoi, je vous propose une librairie permettant de vous connecter facilement et de manière universelle à un serveur SQL.

Par défaut **@Usdc** prend en charge **MySsql**, **SqLite3**, et **Postgres SQL**.

Fonctionnant sur le principe des *Drivers*, il vous sera très rapide de concevoir celui qui vous manque!

<a name="installation"></a>

## Installation

Encore une fois, simplicité est maitre mot.

Copiez/Collez le dossier *'usdc'* et son contenu dans le dossier de votre choix (par exemple: *'libs'*) au niveau de votre applications. Puis, dans le script principal de celle-ci, intégrez **@Usdc** comme suit:

```php
<?php
....

namespace MonApplie;

require_once './libs/usdc/usdc.inc.php';

use Libs\Usdc\Usdc;

....
```

Et c'est tout!

<br>

<a name="utilisations"></a>

## Utilisations

Ok c'est bien beau de savoir à quoi cette libre sert, comment l'installer, mais comment peut on l'utiliser? Une nouvelle fois, vous verrez que je suis resté dans la simpicité ;-)

Pour commencer, il faut savoir que toutes les informations nécessaires, telles les informations de connexion à chaque serveur, devront être définies dans des constantes avant tout utilisation de cette librairie. Nous allons voir ensemble ce que celà signifie.

Une fois ces constantes définies en amont, **@Usdc** s'occupera de tout et vous renverra une instance de la classe PDO connectée correctement au bon serveur de données:

```php
$pdoConnection = Usdc::get()::connection();
```

<a name="mysql"></a>

### Driver: [MySql](https://www.mysql.com/fr/)

Le site [https://sql.sh](https://sql.sh) nous donne la définition:

> MySQL est un Système de Gestion de Base de Données (SGBD) parmi les plus populaires au monde. Il est distribué sous double licence, un licence publique générale GNU et une propriétaire selon l’utilisation qui en est faites. La première version de MySQL est apparue en 1995 et l’outil est régulièrement entretenu.
> 
> Ce système est particulièrement connu des développeurs pour faire partit des célèbres quatuors: WAMP (Windows, Apache, MySQL et PHP), LAMP (Linux) et MAMP (Mac). Ces packages sont si populaires et simples à mettre en oeuvre que MySQL est largement connu et exploité comme système de gestion de base de données pour des applications utilisant PHP. C’est d’ailleurs pour cette raison que la plupart des hébergeurs web proposent PHP et MySQL.

Maintenant que les présentations sont faites, voici quelques lignes de code:

```php
// fichier: config.php
if (!defined('FRAMEL_USDC_ENGINE')) define('FRAMEL_USDC_ENGINE', 'mysql');

if (!defined('FRAMEL_USDC_HOST')) define('FRAMEL_USDC_HOST', 'localhost');
if (!defined('FRAMEL_USDC_PORT')) define('FRAMEL_USDC_PORT', 3306);
if (!defined('FRAMEL_USDC_NAME')) define('FRAMEL_USDC_NAME', 'Framel');
if (!defined('FRAMEL_USDC_USERNAME')) define('FRAMEL_USDC_USERNAME', 'root');
if (!defined('FRAMEL_USDC_PASSWORD')) define('FRAMEL_USDC_PASSWORD', 'Root1234!');

// fichier: index.php
require_once './config.php';

$pdoConnection = Usdc::get()::connection();
```

Vous voyez, nous ne pouvons pas faire plus simple !

Ce driver impose 6 constantes:

- **FRAMEL_USDC_ENGINE**    : Nom du driver à utiliser. Dans le cas présent, ***mysql***
- **FRAMEL_USDC_HOST**      : Adresse / Hôte du serveur MySql
- **FRAMEL_USDC_PORT**      : Port de connexion au serveur
- **FRAMEL_USDC_NAME**      : Nom de la base de donnée sur laquelle vous souhaitez vous connecter
- **FRAMEL_USDC_USERNAME**  : Le nom d'utilisateur
- **FRAMEL_USDC_PASSWORD**  : Et le mot de passe associé

<br>

<a name="sqlite3"></a>

### Driver: [SqlLite3](https://www.sqlite.org/index.html)

Le site [https://sql.sh](https://sql.sh) nous donne la définition:

> SQLite est un système de gestion de base de données relationnelle. Ce moteur de base de données est connu pour implémenter une grande partie du standard SQL-92 et des propriétés ACID.
> 
> Cette bibliothèque écrite en C est directement intégrée au programme. Ce système et son code source sont entièrement dans le domaine public ce qui permet à tout à chacun d’utiliser et de participer à l’évolution de ce projet.

Maintenant que les présentations sont faites, voici quelques lignes de code:

```php
// fichier: config.php
if (!defined('FRAMEL_USDC_ENGINE')) define('FRAMEL_USDC_ENGINE', 'sqlite3');

if (!defined('FRAMEL_USDC_FILE')) define('FRAMEL_USDC_FILE', __DIR__ . '/../../../datas/framel.db');

// fichier: index.php
require_once './config.php';

$pdoConnection = Usdc::get()::connection();
```

Vous voyez, nous ne pouvons pas faire plus simple !

Ce driver impose 2 constantes:

- **FRAMEL_USDC_ENGINE**    : Nom du driver à utiliser. Dans le cas présent, ***sqlite3***
- **FRAMEL_USDC_FILE**      : Chemin du fichier contenant la base de donnée SqLite3

<br>

<a name="postfres"></a>

### Driver: [Postgres SQL](https://www.postgresql.org)

Le site [https://sql.sh](https://sql.sh) nous donne la définition:

> PostgreSQL est un Système de Gestion de Base de Données (SBGD) libre disponible sous licence BSD. Ce système multi-plateforme est largement connu et réputé à travers le monde, notamment pour son comportement stable et pour être très respectueux des normes ANSI SQL. Ce projet libre n’est pas géré par une entreprise mais par une communauté de développeurs.

Maintenant que les présentations sont faites, voici quelques lignes de code:

```php
// fichier: config.php
if (!defined('FRAMEL_USDC_ENGINE')) define('FRAMEL_USDC_ENGINE', 'postgres');

if (!defined('FRAMEL_USDC_HOST')) define('FRAMEL_USDC_HOST', 'localhost');
if (!defined('FRAMEL_USDC_PORT')) define('FRAMEL_USDC_PORT', 3306);
if (!defined('FRAMEL_USDC_NAME')) define('FRAMEL_USDC_NAME', 'Framel');
if (!defined('FRAMEL_USDC_USERNAME')) define('FRAMEL_USDC_USERNAME', 'root');
if (!defined('FRAMEL_USDC_PASSWORD')) define('FRAMEL_USDC_PASSWORD', 'Root1234!');

// fichier: index.php
require_once './config.php';

$pdoConnection = Usdc::get()::connection();
```

Vous voyez, nous ne pouvons pas faire plus simple !

Ce driver impose 6 constantes:

- **FRAMEL_USDC_ENGINE**    : Nom du driver à utiliser. Dans le cas présent, ***postgres***
- **FRAMEL_USDC_HOST**      : Adresse / Hôte du serveur MySql
- **FRAMEL_USDC_PORT**      : Port de connexion au serveur
- **FRAMEL_USDC_NAME**      : Nom de la base de donnée sur laquelle vous souhaitez vous connecter
- **FRAMEL_USDC_USERNAME**  : Le nom d'utilisateur
- **FRAMEL_USDC_PASSWORD**  : Et le mot de passe associé

<br>

<a name="licence"></a>

## Licence et Utilisations

La licence donne à toute personne recevant le logiciel (et ses fichiers) le droit illimité de l'utiliser, le copier, le modifier, le fusionner, le publier, le distribuer, le vendre et le « sous-licencier » (l'incorporer dans une autre licence). La seule obligation est d'incorporer la notice de licence et de copyright dans toutes les copies.


> Copyright (c)2021 Christophe LEMOINE
>
> Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


<br>

<a name="apropos"></a>

## A propos

> *Auteur*: Christophe LEMOINE<br>
> *Email*: pantaflex@hotmail.fr<br>
> *Url*: [https://github.com/pantaflex44/Usdc](https://github.com/pantaflex44/Usdc)<br>
> *Copyright*: Copyright (c)2021 Christophe LEMOINE<br>
> *Licence*: [MIT License](https://github.com/pantaflex44/Usdc/LICENSE)

<br>