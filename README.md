Overview
========

This fork add ability to use xhgui as docker container
Just use ```docker pull duhon/xhgui``` and ```docker pull mongo``` for link mongo to xhgui
Or use docker-compose approach:

````xml
version: '3.2'
services:
  app:
    image: _YOUR_APP_
  mongodb:
    image: mongo
    ports:
      - "27017:27017"
  xhgui:
    image: duhon/xhgui
    depends_on:
      - mongodb
    ports:
      - "0.0.0.0:8088:80"
````

For pass data from tideways to xhgui just add **tideways.ini** to your Application


Below you can find default docs:



xhgui
=====

A graphical interface for XHProf data built on MongoDB.

This tool requires that [Tideways](https://github.com/tideways/php-profiler-extension) are installed.
Tideways is a PHP Extension that records and provides profiling data.
XHGui (this tool) takes that information, saves it in MongoDB, and provides
a convenient GUI for working with it.

Using Tideways Extension
========================

The XHProf PHP extension is not compatible with PHP7.0+. Instead you'll need to
use the [tideways extension](https://github.com/tideways/php-profiler-extension).

Once installed, you can use the following configuration data:

```ini
[tideways]
extension="/path/to/tideways/tideways.so"
tideways.connection=unix:///usr/local/var/run/tidewaysd.sock
tideways.load_library=0
tideways.auto_prepend_library=0
tideways.auto_start=0
tideways.sample_rate=100
```

License
=======

Copyright (c) 2013 Mark Story & Paul Reinheimer

Permission is hereby granted, free of charge, to any person obtaining a
copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
