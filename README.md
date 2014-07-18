# Carta library

Carta offers a simple way to transform different markup languages to HTML (*the irony*). For the moment
it supports Markdown and reStructuredText.

## Example

```php
$carta = new \Gentle\Carta\Carta(
    '/path/to/markdown/files',
    new \Gentle\Carta\Parser\MarkdownParser()
);

# parse a single page and get content
$carta->page('subdir/file.md')->getContent();

# load all files from directory and get each page title
foreach ($carta->chapter('subdir/')->getPages() as $page) {
    echo $page->getMetaTag('title');
}
```

## Page metadata

You can specify custom metadata inside each source file, by using the format `key: value` at the
beginning of the file, surrounded by three or more dashes.

Example:

 ```yaml
 ---
 title: "The page title"
 description: "Page description"
 tags: ["tag1", "tag2"]
 ---
 ```

This will result in the following usage:

 ```php
 // [...]
 $page->getMetaTag('title');        // will return: The page title
 $page->getMetaTag('description');  // will return: Page description
 $page->getMetaTag('tags');         // will return: array('tag1', 'tag2')
 ```

There are no restrictions in place for what meta keys you can use, so you can define any key you want.


## Glossary

The following terms are used inside Carta library:

 - **Page**: refers to a single source file. ( *.md, .rst, etc* )
 - **Chapter**: refers to a directory which contains multiple "*Pages*".

## License

`Carta` is licensed under the MIT License - see the LICENSE file for details
