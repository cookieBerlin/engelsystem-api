=====================
api/v1/resource/shift
=====================

`list <list.html>`__
  List shifts

`create <create.html>`__
  Create a shift

`read <read.html>`__
  Get a shift

`update <update.html>`__
  Update a shift

`delete <delete.html>`__
  Delete a shift

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
