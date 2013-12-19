<?php

namespace Respect\Template;

/**
 * @group wip
 */
class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_TEMPLATING = 'Respect\Template\Html';
    const ATTR_TEMPLATES_PATH = 'templateFinder';
    private $templatePath;

    public function assertPreConditions()
    {
        if (false === class_exists($className = 'Respect\Template\Environment')) {
            $this->markTestSkipped('Missing class '.$className);
        }

        if (false === file_exists($this->templatePath)) {
            $this->markTestSkipped('Missing template directory '.$this->templatePath);
        }
    }

    public function setUp()
    {
        $this->templatePath = __DIR__.'/../../../templates';
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The "/tmp/weird-path" directory does not exist.
     */
    public function new_instance_with_non_existing_path_throws_exception()
    {
        $templatePaths = ['/tmp/weird-path'];
        $template = new Environment($templatePaths);
    }


    /**
     * @test
     * @expectedException Respect\Template\Exception\NotFound
     * @expectedExceptionMessage File not found or not readable: not-found-file.html
     */
    public function create_template_with_missing_file_on_given_paths()
    {
        $templatePaths = [$this->templatePath];
        $template = new Environment($templatePaths);
        $missingFile = 'not-found-file.html';
        $template->templateFile($missingFile);
    }

    /**
     * @test
     */
    public function create_template_with_existing_file_on_given_paths()
    {
        $templatePaths = [$this->templatePath];
        $template = new Environment($templatePaths);
        $fileName = 'title-paragraph.html';
        $templatingInstance = $template->templateString($fileName);
        $this->assertInstanceOf(
            self::CLASS_TEMPLATING,
            $templatingInstance,
            'A templating instance for HTML file was expected.'
        );
    }

    /**
     * @test
     */
    public function create_template_for_html_string_when_no_template_paths_are_given()
    {
        $htmlTemplate = '<h1>Some title for tests</h1>';
        $template = new Environment();
        $templatingInstance = $template->templateString($htmlTemplate);
        $this->assertInstanceOf(
            self::CLASS_TEMPLATING,
            $templatingInstance,
            'A templating instance for HTML string expected.'
        );
    }
}
