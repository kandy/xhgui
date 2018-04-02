<?php

\XH::start();

class XH
{
    static $extensions = [
        'tideways',
        'xhprof',
        'tideways_xhprof'
    ];

    static $detectedExtension = null;

    static function detectExtension()
    {
        foreach (self::$extensions as $extension) {
            if (extension_loaded($extension)) {
                self::$detectedExtension = $extension;
                return true;
            }
        }

        return false;
    }

    static function start()
    {
        if (!self::detectExtension()) {
            error_log('xhgui - profiling must be loaded');
            return;
        }
        call_user_func(
            self::$detectedExtension . '_enable',
            constant (strtoupper(self::$detectedExtension) . '_FLAGS_CPU')
            | constant (strtoupper(self::$detectedExtension) . '_FLAGS_MEMORY')

        );
        register_shutdown_function(
            function () {
                \XH::stop();
            }
        );
    }

    static function stop()
    {
        ignore_user_abort(true);
        flush();

        $data = [
            'profile' => call_user_func(self::$detectedExtension . '_disable'),
            'meta' => [
                'server' => $_SERVER,
                'get' => $_GET,
                'env' => $_ENV,
            ]
        ];

        try {
            self::send('http://xhgui/api.php', $data);
        } catch (\Exception $e) {
            error_log('xhgui - ' . $e->getMessage());
        }
    }

    private static function send($url, $data)
    {
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === false) {
            error_log(file_get_contents('php://input'));
            throw new Exception('fail to send data');
        }
    }
}
