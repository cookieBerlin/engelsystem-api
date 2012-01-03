===========
Create room
===========

Request
=======
::

  POST ${base}/api/v1/resource/room

Request Body
------------
Supply an object in the request body.

Response
========
In successful, this method returns a 201 status, the URI of the newly created object in the Location-header and a partial room object in the response body.
