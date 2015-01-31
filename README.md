#MimeType

Improves mime_type detection over finfo without dependencies on any system utility (such as the Linux file command).

Uses a local cached copy of the mime types from Apache's repository:

http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types

##Installation

###Using Composer

Edit composer.json and add:

    "brianreeve/mime-type": "dev-master"

##Usage

    use BrianReeve/MimeType/MimeType;

    $mimeType = MimeType::detect($path);

The detect method first looks for a match by extension in the list from Apache, then tries finfo, lastly defaults to text/plain.

##To Update to the Latest

To update the cache, run

    php src/BrianReeve/MimeType/Utils/generate_mime_types_array.php

Updated mime types will be saved to

    src/BrianReeve/MimeType/lib/mime_types.json
