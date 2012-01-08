======
API v1
======

API calls
=========
All API calls uses standard HTTP methods to retrieve and manipulate resources.

Data Formats
============
Objects in the API are represented using JSON data formats.

Common Properties
+++++++++++++++++
While each type of resource will have its own unique representation, there are a number of common properties that are found in almost all resource representations.

======================= ========= ===================================
Property name           Value     Description
======================= ========= ===================================
kind                    string    This identifies what kind of resource a JSON object represents. (*read-only*)
id                      string    This property uniquely identifies a resource. (*read-only*)
======================= ========= ===================================

Types
+++++
Some special data types are used to specify data fields.

``datetime``
------------
Date and time formatted as an RFC 3339 timestamp.

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
