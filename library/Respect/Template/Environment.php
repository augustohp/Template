<?php

namespace Respect\Template;

use Symfony\Component\Finder;

class Environment
{
    private $templateFinder;

    public function __construct(array $findTemplatesIn=array())
    {
        $this->templateFinder = new Finder\Finder();
        $this->templateFinder->files();
        foreach ($findTemplatesIn as $directory) {
            $this->templateFinder->in($directory);
        }
    }

    private function findFile($fileName)
    {
        $finder = $this->templateFinder;
        $finder->name($fileName);
        $templateFilesFound = count($finder);
        if (0 === $templateFilesFound) {
            $errorMessage = 'File not found or not readable: %s';
            throw new Exception\NotFound(sprintf($errorMessage, $fileName));
        }

        foreach ($finder as $file) {
            return $file->getRealpath();
        }
    }

    public function templateFile($fileName)
    {
        $templateFile = $this->findFile($fileName);
        return new Html($templateFile);
    }

    public function templateString($htmlString)
    {
        return new Html($htmlString);
    }
}
