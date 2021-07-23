# Mad Lib!
This document explains how this block content for moodle works, as how is installed and a little user guide.


#Installation
- Download or clone repository from github
- Place it inside your moodle project inside this directory : '/PATH/moodle/blocks/'
- Your moodle website will try to update its tables and config the new block
- Voila! you can activate it now in your dashboard or home:
While having page customization on -> Add a block -> Select Mad Lib!

# User Guide

There are 3 important sections to this block.
- A randomized mad lib shows each time a user visits his dashboard
- A form to upload new words that can be used to fill the blanks in sentences.
- A form to upload new sentences

This last 2 sections are only displayed to users with the correct capabilities: :wordmanager and :sentencemanager
To enable this capabilities to a certain role:
 Site Administration -> Users -> Permissions -> Capability Overview
This capabilities can be find with this prefix : block/mad_lib
