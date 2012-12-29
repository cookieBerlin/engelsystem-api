.. include:: ../../common.inc

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
|request:list|

Response
========
|response:list|
