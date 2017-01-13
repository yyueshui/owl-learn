<?php
use Owl\Config;
use Psr\Log\LoggerInterface;

function get_logger($name = 'default')
{
    static $loggers = [];

    $name = strtolower($name);

    if (!isset($loggers[$name])) {
        $logger = new \Monolog\Logger($name);

        $config = Config::get('loggers', $name);
        if (!$config) {
            throw new \Exception('Undefined logger: '.$name);
        }

        foreach ($config['handlers'] as $handler_config) {
            $class = new \ReflectionClass($handler_config['class']);

            $arguments = \Owl\array_get_in($handler_config, ['arguments']) ?: [];
            $handler   = $class->newInstanceArgs($arguments);

            if (isset($handler_config['level'])) {
                $handler->setLevel($handler_config['level']);
            }

            $logger->pushHandler($handler);
        }

        $loggers[$name] = $logger;
    }

    return $loggers[$name];
}

function log_exception(LoggerInterface $logger, $exception, $level = 'error')
{
    if ($previous = $exception->getPrevious()) {
        return log_exception($logger, $previous, $level);
    }

    $message = sprintf('%s(%d): %s', get_class($exception), $exception->getCode(), $exception->getMessage());
    $logger->log($level, $message);

    $traces = explode("\n", $exception->getTraceAsString());
    foreach ($traces as $line) {
        $logger->log($level, $line);
    }
}
