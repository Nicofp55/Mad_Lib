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


# Upload new sentences
It's needed to create the blank(s) of the sentence, click on the different buttons corresponding if the word that shoud occupy this space is a noun, a verb or an adjective. 
This is made to have more cohesion in randomized mad libs.
When clicked, this buttons will generate a piece of shortcode that equals a blank space.
It is recommended to use this interface to generate this spaces.
Clicking on Save changes will upload the new sentence.

# Upload new Words
There are 2 fields for submitting words. Word (pretty self-explanatory) and category.
Category is a dropdown with 3 choices: noun, verb and adjective.
Clicking on Save changes will upload this new word.
