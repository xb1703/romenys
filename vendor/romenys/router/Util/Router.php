<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 29/11/16
 * Time: 23:08
 */

namespace Romenys\Router\Util;


class Router
{
    const TYPE_FILE = 'file';
    const TYPE_ROUTE = 'route';

    private $files = [];

    private $routes = [];

    public function __construct()
    {
        $this->getRoutingFiles();
    }

    private function getRoutingFiles($files = null)
    {
        if ($files === null) {
            $files = json_decode(file_get_contents("app/config/routing.json"), true);
        }

        foreach ($files as $type => $value) {
            if ($type == self::TYPE_FILE) {
                $this->parseRoutingFile($value);
            }

            if ($type === self::TYPE_ROUTE) {
                $this->addRoute($value);
            }
        }
    }

    private function parseRoutingFile($file)
    {
        if (is_array($file)) {
            foreach ($file as $name => $path) {
                if (!file_exists($path)) continue;

                $this->processFileContent(json_decode(file_get_contents($path), true));

                $this->addFiles($name, $path);
            }
        }

    }

    private function processFileContent($fileContent)
    {
        if (is_array($fileContent) && !empty($fileContent)) {
            foreach ($fileContent as $type => $content) {
                if ($type === self::TYPE_ROUTE) {
                    $this->addRoute($content);
                }

                if ($type === self::TYPE_FILE) {
                    $this->getRoutingFiles([$type => $content]);
                }
            }
        }
    }

    private function addFiles($name, $file)
    {
        $this->files[$name] = $file;

        return $this;
    }

    public function getFiles()
    {
        return $this->files;
    }

    private function addRoute($route)
    {
        foreach ($route as $name => $path) {
            $this->routes[$name] = $path;
        }

        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
