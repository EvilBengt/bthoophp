<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

$app->router->get("test-my-text-filter", function () use ($app) {
    $filter = new EVB\MyTextFilter\MyTextFilter();

    $app->page->add("testMyTextFilter/index", [
        "bbcodeRaw" => htmlspecialchars(EVB\MyTextFilter\ExampleProvider::BBCODE),
        "bbcodeHTML" => htmlspecialchars($filter->parse(
            EVB\MyTextFilter\ExampleProvider::BBCODE,
            ["bbcode"]
        )),
        "bbcodeResult" => $filter->parse(
            EVB\MyTextFilter\ExampleProvider::BBCODE,
            ["bbcode"]
        ),
        "linkRaw" => htmlspecialchars(EVB\MyTextFilter\ExampleProvider::LINK),
        "linkHTML" => htmlspecialchars($filter->parse(
            EVB\MyTextFilter\ExampleProvider::LINK,
            ["link"]
        )),
        "linkResult" => $filter->parse(
            EVB\MyTextFilter\ExampleProvider::LINK,
            ["link"]
        ),
        "markdownRaw" => htmlspecialchars(EVB\MyTextFilter\ExampleProvider::MARKDOWN),
        "markdownHTML" => htmlspecialchars($filter->parse(
            EVB\MyTextFilter\ExampleProvider::MARKDOWN,
            ["markdown"]
        )),
        "markdownResult" => $filter->parse(
            EVB\MyTextFilter\ExampleProvider::MARKDOWN,
            ["markdown"]
        ),
        "nl2brRaw" => htmlspecialchars(EVB\MyTextFilter\ExampleProvider::NL2BR),
        "nl2brHTML" => htmlspecialchars($filter->parse(
            EVB\MyTextFilter\ExampleProvider::NL2BR,
            ["nl2br"]
        )),
        "nl2brResult" => $filter->parse(
            EVB\MyTextFilter\ExampleProvider::NL2BR,
            ["nl2br"]
        ),
    ]);

    return $app->page->render([
        "title" => "Testsida | MyTextFilter"
    ]);
});
