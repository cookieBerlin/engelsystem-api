============
Object Shift
============

Methods
=======
.. toctree::
   :maxdepth: 1

   list
   create
   read
   update
   delete

Object representations
======================

::

  {
    "kind": "engelsystem#resource/shift",
    "id": string,
    "name": string,
    "description": string,
    "comments": string,
    "room": {
      "id": string,
      "name": string,
      "description": string,
    }
    "time": {
      "start": datetime,
      "duration": string,
    }
  }

======================= ========= ===================================
Property name           Value     Description
======================= ========= ===================================
kind                    string    Value: "engelsystem#resource/shift"
id                      string    Internal identifier. Read-only
name                    string
description             string
comments                string
room                    object
room.id                 string
room.name               string
room.description        string
time                    object
time.start              datetime
time.duration           string
======================= ========= ===================================
