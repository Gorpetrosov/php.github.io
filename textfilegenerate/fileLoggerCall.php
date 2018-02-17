<?php
spl_autoload_register(function ($FileLogger){
   include $FileLogger.'.php';
});


for ($n = 0; $n < 2; $n++) {
    $logger = new FileLogger("test$n", "test.log");
    $logger->log("Hello!Lilit");
// Теперь нет необходимости заботиться о корректном
// уничтожении объекта - PHP делает все сам!
}
exit();