<?php

/* 
 * Autoload para a raiz App
 */
spl_autoload_register(function (string $class) {
    // Remove o namespace base "App\" do início da classe
    $baseDir = __DIR__ . '/../'; // Diretório raiz do projeto
    $relativeClass = str_replace('App\\', '', $class);

    // Substitui "\" por "/" para formar o caminho do arquivo
    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

    // Verifica se o arquivo existe e o inclui
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception("Classe não encontrada: $class no caminho $file");
    }
});
