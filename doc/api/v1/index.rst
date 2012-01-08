API v1
======

API calls
---------
All API calls uses standard HTTP methods to retrieve and manipulate resources.

Data Formats
------------
Objects in the API are represented using JSON data formats.

Types
+++++
Some special data types are used to specify data fields.

``datetime``
~~~~~~~~~~~~
Date and time formatted as an RFC 3339 timestamp.

Errors
------
::

  {
    "errors": {
      …
    }
  }

Modules
-------
.. toctree::
   :maxdepth: 2

   resource/index
