====================
api/v1/resource/room
====================

Methods
-------

`list <list.html>`__
  List rooms.

`create <create.html>`__
  Create a room

`read <read.html>`__
  Get a room.

`update <update.html>`__
  Update a room

`delete <delete.html>`__
  Delete a room

Object representations
----------------------

::

  {
    "kind": "engelsystem#resource/room",
    "id": string,
    "name": string,
    "description": string,
    "comments": string,
  }

======================= ========= ===================================
Property name           Value     Description
======================= ========= ===================================
kind                    string    Value: "engelsystem#resource/room"
id                      string    Internal identifier. Read-only
name                    string
description             string
======================= ========= ===================================

