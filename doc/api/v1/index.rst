======
API v1
======

API calls
=========
All API calls uses standard HTTP methods to retrieve and manipulate resources.

Data Formats
============
Objects in the API are represented using JSON data formats.

Types
+++++
Some special data types are used to specify data fields.

``datetime``
------------
Date and time formatted as an RFC 3339 timestamp.

``tagstring``
-------------
Translated strings are tagged.
Supported are language definitions as defined in RFC 5646 with a fixed prefix of ``lang-``.
The empty tag is used for absence of defined tags.
All other tags are reserved and should not be used.

Tagged strings are formatted as object of tag as name and string as value.
If the correct tag can be determined by information provided by a lower protocol layer,
e.g. a Accept-Language-Header in the HTTP request,
the value can be returned as simple string.

Example
.......
::

  {
    "": "angel",
    "lang-de": "Engel",
  }

If the request sets ``Accept-Language: de``, the value can be returned as string.

::

  "Engel"

Common Properties
+++++++++++++++++
While each type of resource will have its own unique representation, there are a number of common properties that are found in almost all resource representations.

======================= ========= ===================================
Property name           Value     Description
======================= ========= ===================================
kind                    string    This identifies what kind of resource a JSON object represents. (*read-only*)
id                      string    This property uniquely identifies a resource. (*read-only*)
name                    tagstring The display name of a resource.
description             tagstring
======================= ========= ===================================

Errors
======
::

  {
    "errors": {
      …
    }
  }

Modules
=======
.. toctree::
   :maxdepth: 2

   resource/index
