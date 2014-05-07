This project includes the text of common open-source licenses as well as an
index with titles and identifiers.

## index.csv

The index is in a spreadsheet file, index.csv, with columns:

 * Short name
 * Title
 * Relative path of the license's text file

## Tokens

The license may include some tokens which should be replaced when
applied to a given project:

 * TITLE: The name of the work being licensed
 * OWNER: The person or entity which holds copyright on the
   code and which licenses the code.
 * YEAR: The year(s) of authorship

## Helper classes

If you're using PHP to process the data and don't want to sully the code
with references to specific file paths or formats, then use the autoloaded
classes \LicenseData\Repository and \LicenseData\License. For example:

```php
$licenses = new \LicenseData\Repository();
echo $licenses->get('LGPL-2.1+')->getText();
```
