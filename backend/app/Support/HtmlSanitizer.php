<?php

namespace App\Support;

class HtmlSanitizer
{
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 'a', 'ul', 'ol', 'li',
        'h2', 'h3', 'h4', 'blockquote', 'img', 'figure', 'figcaption',
        'code', 'pre', 'span',
    ];

    private const ALLOWED_ATTRS = ['href', 'src', 'alt', 'title', 'class', 'target', 'rel'];

    private const STRIP_ENTIRELY = [
        'script', 'style', 'iframe', 'object', 'embed', 'form',
        'input', 'textarea', 'button', 'svg', 'math', 'link', 'meta',
    ];

    public static function clean(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return $html;
        }

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML(
            '<?xml encoding="utf-8" ?><div>' . $html . '</div>',
            LIBXML_NOERROR | LIBXML_NOWARNING
        );
        libxml_clear_errors();

        $root = $doc->getElementsByTagName('div')->item(0);
        if (! $root) {
            return '';
        }

        self::cleanNode($doc, $root);

        $output = '';
        foreach (iterator_to_array($root->childNodes) as $child) {
            $output .= $doc->saveHTML($child);
        }

        return $output;
    }

    private static function cleanNode(\DOMDocument $doc, \DOMNode $node): void
    {
        $children = iterator_to_array($node->childNodes);

        foreach ($children as $child) {
            if ($child->nodeType === XML_ELEMENT_NODE) {
                $tag = strtolower($child->nodeName);

                if (in_array($tag, self::STRIP_ENTIRELY, true)) {
                    $node->removeChild($child);
                    continue;
                }

                if (! in_array($tag, self::ALLOWED_TAGS, true)) {
                    // Unwrap: replace the disallowed element with its children
                    while ($child->firstChild) {
                        $node->insertBefore($child->firstChild, $child);
                    }
                    $node->removeChild($child);
                    continue;
                }

                /** @var \DOMElement $child */
                foreach (iterator_to_array($child->attributes) as $attr) {
                    $attrName = strtolower($attr->nodeName);

                    if (! in_array($attrName, self::ALLOWED_ATTRS, true)) {
                        $child->removeAttribute($attr->nodeName);
                        continue;
                    }

                    if (str_starts_with($attrName, 'on')) {
                        $child->removeAttribute($attr->nodeName);
                        continue;
                    }

                    if (in_array($attrName, ['href', 'src'], true)) {
                        $value = trim($attr->nodeValue);
                        if (preg_match('/^\s*(javascript|data|vbscript)\s*:/i', $value)) {
                            $child->removeAttribute($attr->nodeName);
                        }
                    }
                }

                self::cleanNode($doc, $child);
            }
        }
    }
}
