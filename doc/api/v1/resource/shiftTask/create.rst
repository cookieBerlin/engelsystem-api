.. include:: ../../common.inc

===========
Create task
===========

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
|response:create|
