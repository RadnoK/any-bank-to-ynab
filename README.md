# YNAB Translator

This is a simple library to translate your bank exported transactions (as a csv file) to YNAB format.

### Currently supported Banks:

- mBank (Poland)

## Installation

Just a simple installation needed (*composer* is required)
```bash
$ composer install
```

## Usage

#### mBank
```bash
$ bin/console radnok:ynab-translator:mbank <csv-file-path>
```

## Development

Running tests:

```bash
$ composer tests
```

## Contributing

Any contributions are welcome.
