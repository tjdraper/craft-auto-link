# Auto Link Twig Filter for Craft

Just like the label on the box suggests, this is a simple Twig filter that will turn URLs in a string into clickable HTML anchors.

## Installation

1. Put the `autolink` directory in `craft/plugins`
2. Go into the Craft control panel and navigate to `settings -> plugins` and click install on the Auto Link item.

## Usage

You can use the Twig filter on any string variable like so:

```
{{ myStringVar|autolink }}
```
