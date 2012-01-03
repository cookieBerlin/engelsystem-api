==========
List rooms
==========

Request
=======
::

  GET ${base}/api/v1/resource/room

Parameters
----------

============== ========= =====================================================
Parameter name Value     Description
============== ========= =====================================================
filter         string    Filter after name and description
filter_name    string    Filter after name
============== ========= =====================================================

Request Body
------------
Do not supply a request body with this method.

Response
========
In successful, this method returns a 200 status and a list of room objects in the response body.
