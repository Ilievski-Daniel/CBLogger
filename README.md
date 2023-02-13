#### Installation

##### Add to composer.json
````json
  "repositories": [{
      "type": "composer",
      "url": "https://codebridge:1$packages@packages.codebridge.nl"
  }],
````

##### Install
````composer require codebridge/cblogger ````
   
#### Configuration
##### Add binding to AppServiceProdiver's register function

````php
    public function register()
    {
        $this->app->bind('cb_multichannellog', \CodeBridge\CBLogger\MultiChannelLogger::class);
    }
````

##### Add alias to config/app.php
````php
    'aliases' => [
        'Log' => CodeBridge\CBLogger\Facades\MultiChannelLogFacade::class,
    ]
````

##### Usage
````php
    CBLog::debug('started tree chop', [$context], 'logs');
    CBLog::info('chopped tree', [$context], 'logs');
    CBLog::critical('converted to 1000 planks', [$context], 'logs-'.date('m-Y'));
    CBLog::notice('converted to plank', [$context], 'logs');
````
  