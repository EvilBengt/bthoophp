<?php

namespace EVB\MyTextFilter;

class ExampleProvider
{
    public const BBCODE = <<<END
[b]Bold text[/b] [i]Italic text[/i] [url=http://dbwebb.se]a link to dbwebb[/url]

And then an image.
[img]https://dbwebb.se/image/tema/trad/blad.jpg[/img]
END;

    public const LINK = <<<END
<p>
    This is an example of using the PHP-function <code>make_clickable()</code>. The function takes a
    text as argument and looks through it using a regular expression. The expression matches all
    <a href="http://sv.wikipedia.org/wiki/Uniform_Resource_Locator">URLs</a> that are in the text
    and makes them clickable, without messing up the links that are already there.
</p>
<p>
    The url must start with <b>http</b> or <b>https</b>. The regular expression ignores all links that
    are already available within an existing anchor (href) or iframe (src).
</p>
<p>
    This link should for example be made clickable: http://dbwebb.se
    and so should this link
    http://dbwebb.se/kod-exempel/function_to_make_links_clickable/
    and so should this:
    http://dbwebb.se/kod-exempel/function_to_make_links_clickable#id.
</p>
<p>
    The initial code came from Wordpress where such function exists. The function was then
    <a href="/t/254">modified in this forumthread</a>.
</p>

<h3>More tests</h3>

<p>
    Here are some URLs:
    stackoverflow.com/questions/1188129/pregreplace-to-detect-html-php
    Here's the answer:
    http://www.google.com/search?rls=en&q=42&ie=utf-8&oe=utf-8&hl=en.
    What was the question?
    A quick look at
    http://en.wikipedia.org/wiki/URI_scheme#Generic_syntax
    is helpful.
    There is no place like 127.0.0.1! Except maybe
    http://news.bbc.co.uk/1/hi/england/surrey/8168892.stm?
    Ports: 192.168.0.1:8080,
    https://example.net:1234/.
    Beware of Greeks bringing internationalized top-level domains: xn--hxajbheg2az3al.xn--jxalpdlp.
    And remember.Nobody is perfect.
</p>
END;

    public const MARKDOWN = <<<END
Header level 1 {#id1}
=====================

Here comes a paragraph.

* Unordered list
* Unordered list again



Header level 2 {#id2}
---------------------

Here comes another paragraph, now intended as blockquote.

1. Ordered list
2. Ordered list again

> This should be a blockquote.



### Header level 3 {#id3}

Here will be a table.

| Header 1 | Header 2     | Header 3 | Header 4      |
|----------|:-------------|:--------:|--------------:|
| Data 1   | Left aligned | Centered | Right aligned |
| Data     | Data         | Data     | Data          |

Here is a paragraph with some **bold** text and some *italic* text and a [link to dbwebb.se](http://dbwebb.se).
END;

    public const NL2BR = <<<END
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum felis a lorem cursus
    vehicula. Nunc commodo nec sem at condimentum. Cras ac aliquet turpis, vel eleifend tortor. Nullam
    semper, lectus nec rutrum efficitur, metus tellus dictum ligula, a tempor ex diam sit amet orci.
    Nulla gravida enim id purus eleifend, sit amet
    maximus leo fermentum. Mauris sed neque aliquet,
    gravida mauris porttitor, pellentesque eros. Pellentesque eu porta turpis. Sed commodo laoreet dui,
    tempor congue diam hendrerit ut. Integer enim mauris, luctus non consectetur eu, efficitur in nisl.
    Sed tempor, diam eu cursus varius, nulla lectus cursus dolor, vitae semper libero lacus in massa.
END;
}
