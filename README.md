# OpenCensus Zipkin Exporter for PHP

This library provides an [`ExporterInterface`][exporter-interface] for exporting
Trace data to a Zipkin instance.

[![CircleCI](https://circleci.com/gh/census-instrumentation/opencensus-php-exporter-zipkin.svg?style=svg)](https://circleci.com/gh/census-instrumentation/opencensus-php-exporter-zipkin)
[![Packagist](https://img.shields.io/packagist/v/opencensus/opencensus-exporter-zipkin.svg)](https://packagist.org/packages/opencensus/opencensus)
![PHP-Version](https://img.shields.io/packagist/php-v/opencensus/opencensus-exporter-zipkin.svg)

## Installation & basic usage

1. Install the `opencensus/opencensus-exporter-zipkin` package using [composer][composer]:

    ```bash
    $ composer require opencensus/opencensus-exporter-zipkin:~0.1
    ```

1. Initialize a tracer for your application:

    ```php
    use OpenCensus\Trace\Tracer;
    use OpenCensus\Trace\Exporter\ZipkinExporter;

    Tracer::start(new ZipkinExporter('my-service-name'));
    ```

## Customization

TODO: Fill out these instructions

## Versioning

[![Packagist](https://img.shields.io/packagist/v/opencensus/opencensus-exporter-zipkin.svg)](https://packagist.org/packages/opencensus/opencensus-exporter-zipkin)

This library follows [Semantic Versioning][semver].

Please note it is currently under active development. Any release versioned
0.x.y is subject to backwards incompatible changes at any time.

**GA**: Libraries defined at a GA quality level are stable, and will not
introduce backwards-incompatible changes in any minor or patch releases. We will
address issues and requests with the highest priority.

**Beta**: Libraries defined at a Beta quality level are expected to be mostly
stable and we're working towards their release candidate. We will address issues
and requests with a higher priority.

**Alpha**: Libraries defined at an Alpha quality level are still a
work-in-progress and are more likely to get backwards-incompatible updates.

**Current Status:** Alpha


## Contributing

Contributions to this library are always welcome and highly encouraged.

See [CONTRIBUTING](CONTRIBUTING.md) for more information on how to get started.

## Releasing

See [RELEASING](RELEASING.md) for more information on releasing new versions.

## License

Apache 2.0 - See [LICENSE](LICENSE) for more information.

## Disclaimer

This is not an official Google product.

[exporter-interface]: https://github.com/census-instrumentation/opencensus-php/blob/master/src/Trace/Exporter/ExporterInterface.php
[census-org]: https://github.com/census-instrumentation
[composer]: https://getcomposer.org/
[semver]: http://semver.org/
