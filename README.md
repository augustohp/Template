# Respect/Template

Templates, revisited.

> You know what [HTML][uggly_example_1] [templates][uggly_example_2] [look][uggly_example_3] [like][uggly_example_4] today? Fucking bizzare! (start of a [PHPinga][br_phpsp_phpinga])

Instead of focusing on providing *sexy and usefull HTML markup,* they try to do everything else: cache, security, internatialization, parser, D(what)S(the)L(fuck) and so on.

- [ ] We will use HTML. We will produce HTML, we will breathe HTML!
- [ ] Give developers what is to them, let web designers design.
- [ ] We (may) want to use it as a template for configuration files as well.  (Ex: `default.vcl`)

## First time here?

`Respect/Template` is a micro component that does templates, let's see how a template may look like:

```html
    <!-- File: /templates/html/part/component-vcard.html -->
    <div class="vcard">
        <a class="n org url" href="http://respect.li/">
            <span class="honorific-prefix">
                <a class="fn org url" href="http://php.net">PHP</a>:
            </span>
            <span class="family-name">Respect</span>/
            <span class="given-name">Template</span>
        </a>
        <time class="bday" datetime="2011-12-04T18:00:00-02:00">Since 2011</time>
    </div>
```

We encourage designers to design on top of a real HTML markup, with real (or stub) data so the semantic of elements can also be used (seamlessly) as a communication tool with developers.

For now, let's suppose we have a PHP script that fetches all [Respect][respect] component names and saves to an array. Using the resulting array of that program, we could create a HTML list of the components:

```php
    <?php
    
    use Respect\Template;
    
    $components = ['Template', 'Rest', 'Validation', 'Config', 'Relational'];
    $componentTemplate = new Template\Html('templates/html/part/component-vcard.html');
    
    array_map($components, function($name) use ($componentTemplate) {
        $component = clone $componentTemplate;
        $component['.vcard .given-name'] = $name;

        return $component;
    });
 ```

What we just did with [Respect/Template][respect_template]:

1. Created a HTML template using the file containing the previous templated presented as example.
2. Changed the content of the element given by CSS selector `.vcard .given-name` to `$name`.

In case you may be wondering, the [array_map][php_array_map] function replaced the string (which was the name of the component) with a [clonned][php_clone] [instance][php_instance] of  the template. So, now the `$components` array contains only instances of `Respect\Template\Html`.

If we had a place to render those components into, like the following template:

```html
    <!-- File: /templates/html/base/html5.html -->
    <!DOCTYPE html>
    <html lang="en_UK">
        <head>
            <title>Don't forget to change this</title>
            <meta name="auhor" content="Respect Panda" />
            <meta name="editor" content="vim" />
            <meta charset="utf-8" />
            <link rel="profile" href="http://microformats.org/profile/hcard">
        </head>
        <body>
            <h1>Some title</h1>
            <main>
                <p>Some wonderful content.</p>
            </main>
        </body>
    </html>
```
 
The complete [PHP][] script we were making would be something like:

```php 
    <?php
    
    use Respect\Template;
    
    $components = ['Template', 'Rest', 'Validation', 'Config', 'Relational'];
    $componentTemplate = new Template\Html('templates/html/part/component-vcard.html');
    array_map($components, function($name) use ($componentTemplate) {
        $component = clone $componentTemplate;
        $component['.vcard .given-name'] = $name;

        return $component;
    });
    
    $layoutTemplate = new Template\Html('templates/html/base/html5.html');
    $layoutTemplate['h1'] = 'The Respect compoents';
    $layoutTemplate['main'] = $components;
    
    echo $layoutTemplate;
```
    
If you guessed that the above PHP script would output an HTML 5 page containing the list of Respect components (using the [vcard][]), sweet! You guessed right!

### What we just saw

1. Pure HTML templates, which web designers and web developers can build upon its infinite semantics and design options.
2. Readable, PHP-friendly code: reading an HTML template, copying and changing (with CSS selectors) its contents and injecting it on another HTML template.
3. Rendering a perfect, (as human) readable (as possible), W3C validated, HTML output.

## Wanna try it?!

Please, follow to the [docs][respect_template_docs] folder into this repository for more information.

If you know how to use [composer][php_composer], than you can start using it! It doen't get any more complicate than shown here, believe us.

[uggly_example_1]: http://example.org
[uggly_example_2]: http://example.org
[uggly_example_3]: http://example.org
[uggly_example_4]: http://example.org
[uggly_example_5]: http://example.org
[vcard]: http://example.org
[php]: http://example.org
[php_array_map]: http://example.org
[php_clone]: http://example.org
[php_instance]: http://example.org
[php_composer]: http://getcomposer.org
[respect]: http://respect.li
[respect_template]: http://example.org
[respect_template_docs]: http://example.org
[br_phpsp_phpinga]: http://example.org
