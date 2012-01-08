========
Get task
========

Request
=======
::

  GET ${base}/api/v1/resource/shift/${shift_id}/tasks/${type_id}/${task_id}

Request Body
------------
Do not supply a request body with this method.

Response
========
If successful, this method returns a 200 status and a shift object in the response body.
