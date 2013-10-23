This is a Globally Configured HTML Site Announcements Block
(c) 2013, Thunderbird School of Global Management

DESCRIPTION:
This block functions much like the standard HTML block, with the exception that the title and content of
the block is globally configured by the Moodle site administrator. It can be used to show 'site annoucements'
on any page where you can show a block inside Moodle.

This can be used as a 'sticky' block with announcements that show on any course, or on anything under a category.
(see eg. https://moodle.org/mod/forum/discuss.php?d=130002 )

If not made sticky, each course then has the option to add this block, without the need to enter content.
This can eg. be used to make a pre-configured site-wide "announcements" block available to courses,
without faculty having to enter content.
If allowed in the global config, each instance can add additional html content below the predefined content.
This allows the block to be somewhat customized for specific courses.

NOTE:
This block is tested in Moodle v2.3+

INSTALLATION:
Unzip these files to the appropriate directories under your Moodle install, namely
   <html>/blocks/announcements_tbird/
Then as Moodle admin, go to the Notifications entry of your Admin block.
The block should be found and added to the list of available block.

USAGE:

* enable the block in Site Admin -> Modules -> Blocks -> Manage Block; click on the closed eye.

* next, configure it. Click on the Settings link behind the block.go to Site Admin -> Modules -> Blocks 
	Enter Title, Content and Footer as needed. Allow added custom content if needed.
	If not title is set, the block will be rendered with the header that normally has the title.
	If the footer is set, this will be shown centered at the bottom of the block.
	Enter HTML in the content area as needed. At this time, for simplicity, no HTML editor is rendered
	(this is currently not easily provided by the Moodle functions that allow global storage of field data)
	
* Courses can now add a block named as the title given above, or if no title is given, named 'Site Announcements'


HOW TO USE THIS BLOCK AS THE BASE FOR SEVERAL GLOBALLY CONFIGURED HTML BLOCKS:

You can simply copy all the files of this block to create multiple different versions of global html blocks.

Eg. How to make a 2nd global html block, with different content:

1 - Copy the folder 'announcements_tbird' to 'yourblockname' (or whatever is appropriate instead of 'yourblockname')
2 - Rename the file block_annoucements_tbird.php to block_yourblockname.php
3 - Rename the file lang/en_utf8/block_announcements.php to lang/en_utf8/block_yourblockname.php
2 - Modify all occurances of 'announcements' to 'yourblockname' in the files in this new directory (recursively).
6 - Modify the 'blockname' entry in the language file lang/en/block_yourblockname.php according to your use.
    This will be the name as shown in the Admin Blocks section.
7 - Follow the above listed steps to enable and configure this new block.

VERSION CHANGES:

20131023 - Initial version
