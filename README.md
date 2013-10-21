
https://www.mediawiki.org/wiki/User:Kaldari/Interview_task_1

This may not scale for production, as this implementation requires
mysql to visit every relevant revision to do the count.

Use test.html for a form to make a request.

Example request: api.php?categoryName=Afrika_Borwa&startDate=2011-07-31&endDate=2013-10-17&limit=100
Example output: see test-output.json

The main parts of the code (e.g. SQL) are in src/Toppagesincategory.php .

Because I assume it is in the spirit of the tasks intended duration I didn't
finish cleaning it up (which I'd want to do if it were something that others
would use). Needed cleanups would be modularising src/Toppagesincategory.php to
make it testable, full phpunit coverage, phpdoc comments.

