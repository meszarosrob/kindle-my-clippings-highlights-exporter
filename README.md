# (OMG, another) Kindle My Clippings(.txt) Highlights Exporter(!)

## FYI

While the source code is here for everyone's benefit,
this is a personal project to serve my modest needs.

## Setup and usage

With Docker and Docker Compose installed, run:

```shell
docker compose build app
docker compose run app composer install
```

Add your `My Clippings.txt` to the `./data/` directory.

<details>
    <summary>Sample file content</summary>

```txt
A Path with Heart (Jack Kornfield)
- Your Highlight on Location 717-720 | Added on Monday, September 16, 2019 5:42:57 PM
In the monastery of our own sitting meditation, each of us experiences whatever arises again and again as we let go, saying, “Ah, this too.” The simple phrase, “This too, this too,” was the main meditation instruction of one great woman yogi and master with whom I studied. Through these few words we were encouraged to soften and open to see whatever we encountered, accepting the truth with a wise and understanding heart.

==========

Daniel Stein, tolmács (Ljudmila Ulickaja)
- Your Highlight on Location 3726-3726 | Added on Thursday, September 12, 2019 7:55:50 PM
aspirantúrát.

==========

Kafka a tengerparton (Haruki, Murakami)
- Your Note on Location 870 | Added on Tuesday, July 30, 2019 11:43:23 PM
Ez lenne a srác a 3. fejezetbôl - az egyetlen, aki nem ébredt fel

==========

Daniel Stein, tolmács (Ljudmila Ulickaja)
- Your Bookmark on Location 255 | Added on Wednesday, August 28, 2019 11:23:10 PM

==========
```

</details>

The output should be in the `./data/` directory once you run:

```shell
docker compose run app php index.php
```

## Customization (dev)

```php
new Command\Convert\MyClippingsToOutputCollectionFacade(
    new Command\Convert\EnglishClippingToMeta(), // <- your language-aware parser-converter
    new Command\Convert\HighlightToBacklinkedOutput(), // <- your desired output-formatter
);
```

### Non-English Kindle

If you have changed your Kindle's language setting to other than English,
this exporter won't work out of the box.
The clippings' meta-informations are stored in the language of the device.

You can provide your language-aware clipping parser-converter.

### Output content and name

If you still contemplate using this for whatever reason,
the outputs' content format most likely won't suit you.

This is the other thing you can swap easily.

## Support, licence, changelog, and other

See the [`LICENCE`](./LICENCE), and for the rest... c'mon, this is not that kind of project.
