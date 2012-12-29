============
Object Shift
============

Object representations
======================
::

  {
    "kind": "engelsystem#resource/shift",
    "id": string,
    "name": tagstring,
    "description": tagstring,
    "room": {
      "id": string,
      "name": tagstring,
      "description": tagstring,
    }
    "time": {
      "start": datetime,
      "duration": string,
    }
    "shifts": {
    }
  }

======================= ========= ===================================
Property name           Value     Description
======================= ========= ===================================
kind                    string    Value: "engelsystem#resource/shift"
room                    object
room.id                 string    Unique identification of room.
room.*                  all       (*read-only*)
time                    object
time.start              datetime
time.duration           string
shifts                  object?
======================= ========= ===================================

Modify
------
::

  {
    "name": tagstring,
    "description": tagstring,
    "room": {
      "id": string,
    }
    "time": {
      "start": datetime,
      "duration": string,
    }
  }

Methods
=======
.. toctree::
   :maxdepth: 1

   list
   create
   read
   update
   delete
