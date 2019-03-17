# YNAB Translator

This is a simple library to translate your bank exported transactions (csv file) to YNAB format

### Currently supported Banks:

- mBank (Poland) - `mbank`


## Installation

Just a simple installation needed (*composer* is required)
```bash
$ composer install
```

## Usage

```bash
$ bin/console radnok:ynab-translator:<bank-name> <csv-file-path> [<start-date>] [<last-date>]
```


## Development

Running tests:

```bash
$ composer tests
```

