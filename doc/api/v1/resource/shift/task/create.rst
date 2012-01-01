---------------------------------
api/v1/resource/shift/task/create
---------------------------------

Request
=======
::

  POST ${base}/api/v1/resource/shift/${shift_id}/tasks/${type_id}

Parameters
----------

============== ========= =====================================================
Parameter name Value     Description
============== ========= =====================================================
person         string    Person-ID
============== ========= =====================================================

Request Body
------------
Do not supply a request body with this method.

Response
========
In successful, this method returns a 201 status and the URI of the newly created object in the Location-header.