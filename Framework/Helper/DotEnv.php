<?php 

declare(strict_types=1);

namespace Septillion\Framework\Helper;

final class DotEnv 
{
    public function __construct(private string $pathToEnvFile)
    {
        if (!file_exists($this->pathToEnvFile)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $this->pathToEnvFile));
        } 
    }

    public function loadFile(): void
    {
        if (!is_readable($this->pathToEnvFile)) {
            throw new \RuntimeException(sprintf('%s file is not readable', $this->pathToEnvFile));
        }

        $lines = file($this->pathToEnvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
        
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
