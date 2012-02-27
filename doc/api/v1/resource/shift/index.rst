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
  }

======================= ========= ===================================
Property name           Value     Description
======================= ========= ===================================
kind                    string    Value: "engelsystem#resource/shift"
room                    object
time                    object
time.start              datetime
time.duration           string
======================= ========= ===================================

Methods
=======
.. toctree::
   :maxdepth: 1

   list
   create
   read
   update
   delete
