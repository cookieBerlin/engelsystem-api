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
    "room": object,
    "time": {
      "start": datetime,
      "duration": string,
    }
    "tasks": [
      object
    ]
  }

======================= ========= ===================================
Property name           Value     Description
======================= ========= ===================================
kind                    string    Value: "engelsystem#resource/shift"
room                    object    see :doc:`../room/index`
time                    object
time.start              datetime
time.duration           string
tasks                   list      see :doc:`../shift-task/index`
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
