Bernard
=======

Welcome to Bernard's documentation!

Bernard is a extensible library for working with message queues in PHP. It defines structure and conventions
for consuming and producing message with support for a wide variety of backends.

Quick Overview
--------------

Installing
----------

Installing Bernard is as easy as adding a single line [#f1]_ in you ``composer.json`` file. This can be done with
the following command:

.. code-block:: bash

    $ composer require bernard/bernard:~1.0@dev

Examples
--------

If you are not sure what or how Bernard works. We have included a directory containing full examples with a
consumer and producer for each driver we support. Theese can be found in the ``example/`` directory.

Each driver has it own file like ``example/phpredis.php``. Each take a parameter of ``produce`` or ``consume``.

The examples will output information about falling messages when consuming. The receiver used in the example
will throw an exception if a random value equals 7.

Here is an example of running the producer and consumer example for redis [#f2]_.

Open two terminal windows and i the first run the following command:

.. code-block:: bash

    $ cd /path/to/bernard
    $ php ./example/phpredis.php produce

And in the second window run:

.. code-block:: bash

    $ cd /path/to/bernard
    $ php ./example/phpredis.php consume

.. rubric:: Footnotes

.. [#f1] Specific drivers may have additional dependencies that must be installed aswell. You can find more
   information about these in the documentation for each.
.. [#f2] The redis example requires the PHP redis extension to be installed.
