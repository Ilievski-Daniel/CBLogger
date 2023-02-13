<?php

namespace CodeBridge\CBLogger;

use CodeBridge\CBLogger\Model\CBLogger;
use Monolog\Logger;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;

/**
 * Class LogToChannels
 *
 * @package App\Helpers
 */
class MultiChannelLogger
{
    const DEFAULT_CHANNEL = 'laravel';
    /**
     * The LogToChannels channels.
     *
     * @var Logger[]
     */
    protected $channels = [];

    /**
     * @var array
     */
    private $options = [];


    /**
     * LogToChannels constructor.
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->options = $options;
    }

    /**
     * @param int $level The error level
     * @param string $message The error message
     * @param array $context Optional context arguments
     *
     * @param string $channel The channel to log the record in
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function log(int $level, string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        if($this->options['use_database'] && $channel !== self::DEFAULT_CHANNEL) {
            return (bool)CBLogger::create([
                'message' => $message,
                'level_int' => $level,
                'level_string' => Logger::getLevelName($level),
                'context' => json_encode($context),
                'channel' => $channel
            ]);
        }

        // Add the logger if it doesn't exist
        if (!isset($this->channels[$channel])) {
            $handler = new StreamHandler(
                storage_path() . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $channel . '.log'
            );

            $this->addChannel($channel, $handler);
        }

        // LogToChannels the record
        return $this->channels[$channel]->{Logger::getLevelName($level)}($message, $context);
    }

    /**
     * Add a channel to log in
     *
     * @param string $channelName The channel name
     * @param HandlerInterface $handler The channel handler
     * @param string $path The path of the channel file, DEFAULT storage_path()/logs
     *
     * @throws \Exception When the channel already exists
     */
    public function addChannel(string $channelName, HandlerInterface $handler, string $path = null)
    {
        if (isset($this->channels[$channelName])) {
            throw new \Exception('This channel already exists');
        }

        $this->channels[$channelName] = new Logger($channelName);
        $this->channels[$channelName]->pushHandler(
            new $handler(
                $path === null ?
                    storage_path() . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . $channelName . '.log' :
                    $path . DIRECTORY_SEPARATOR . $channelName . '.log'
            )
        );
    }

    /**
     * Adds a log record at the DEBUG level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function debug(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::DEBUG, $message, $context, $channel);
    }

    /**
     * Adds a log record at the INFO level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function info(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::INFO, $message, $context, $channel);
    }

    /**
     * Adds a log record at the NOTICE level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function notice(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::NOTICE, $message, $context, $channel);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function warn(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::WARNING, $message, $context, $channel);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function warning(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::WARNING, $message, $context, $channel);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function err(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::ERROR, $message, $context, $channel);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function error(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::ERROR, $message, $context, $channel);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function crit(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::CRITICAL, $message, $context, $channel);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return Boolean Whether the record has been processed
     * @throws \Exception
     */
    public function critical(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::CRITICAL, $message, $context, $channel);
    }

    /**
     * Adds a log record at the ALERT level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function alert(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::ALERT, $message, $context, $channel);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function emerg(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::EMERGENCY, $message, $context, $channel);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @param  string $channel The channel name
     * @return bool Whether the record has been processed
     * @throws \Exception
     */
    public function emergency(string $message, array $context = [], string $channel = self::DEFAULT_CHANNEL): bool
    {
        return $this->log(Logger::EMERGENCY, $message, $context, $channel);
    }
}