# PHP safe exception

Assalomu aleykum. These components will help you hide your exception and save it in your application.

-----
## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require zafarjonovich/php-safe-exception
```

or add

```
"zafarjonovich/php-safe-exception": "*"
```

to the require section of your `composer.json` file.

## Package structure
<br>


Every exception will converts other specific type. Now this types have:
- Json: \zafarjonovich\PHPSafeException\converter\JsonConverter::class
- Xml: \zafarjonovich\PHPSafeException\converter\XMLConverter::class
- Array: \zafarjonovich\PHPSafeException\converter\ArrayConverter::class
- Text: \zafarjonovich\PHPSafeException\converter\TextConverter::class

<br>


Every converted exception will saves specific places. Now this places have:
- File: \zafarjonovich\PHPSafeException\saver\FileSaver::class
- Telegram bot: \zafarjonovich\PHPSafeException\saver\TelegramBotSaver::class

Each saver has a personal configuration, if they are not confugurated, Exception will not be saved

### Configurations

- TelegramBotSaver: token and chat_ids
- FileSaver: filePath or pathGenerator

## Usage

```php

<?php

require_once 'vendor/autoload.php';

use \zafarjonovich\PHPSafeException\saver\FileSaver;
use zafarjonovich\PHPSafeException\converter\JsonConverter;

try {
    throw new \Exception('My awesome exception');
} catch (\Exception $exception) {
    $saver = new FileSaver('exceptions/'.time().'.txt');
    $saver->save(new JsonConverter($exception));
}

?>

```

Also you can use multiple savers


```php

<?php

require_once 'vendor/autoload.php';

use zafarjonovich\PHPSafeException\saver\FileSaver;
use zafarjonovich\PHPSafeException\saver\TelegramBotSaver;
use zafarjonovich\PHPSafeException\components\MultipleSaver;
use zafarjonovich\PHPSafeException\converter\TextConverter;

try {
    throw new \Exception('My awesome exception');
} catch (\Exception $exception) {
    
    $saver = new MultipleSaver();
    
    $saver->addSaver(new FileSaver('exceptions/'.time().'.txt'));
    $saver->addSaver(new TelegramBotSaver('BOT_TOKEN',['chat_id1','chat_id2','chat_id3']));
    
    $saver->save(new TextConverter($exception));
    
}

?>

```
