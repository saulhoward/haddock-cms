# Introduction #

Some Haddock modules define a class called "SPoE". e.g.

  * ` DBPages_SPoE `

These classes contain public static functions that only accept arguments and return variables of built-in types (numbers, strings, arrays, void etc.).

e.g.

```
...
<div id="content">
<?php
echo DBPages_SPoE::get_filtered_page_section('about-us', 'content');
?>
</div>
...
```

This function fetches the relevant content from the database, processes it somehow ("filter") and then returns a string.

How this is achieved (what SQL queries are sent off, is the data in MySQL, SQLite or something else, what object-oriented design patterns have been used, how the data is cached etc.) is totally irrelevant to the coder writing the code above. Such details are kept hidden.

# What does SPoE stand for? #

Originally, "SPoE" was short for "Single Point of Entry". It was realised quickly that this was much too great a restriction on the functionality of a module. Now we can think of "SPoE" as "Simplest Point of Entry" or "Safest Point of Entry".

PHP does not provide any mechanism for enforcing such restrictions. In Java there are packages and the `protected` keyword, which allows a package designer to enforce a policy like this. If you can't enforce a law, you have to assume that people will break it.

# Who are SPoE functions for? #

If you're not interested in how the internals of a module work (what the table structure is like, how the classes interact with each other, what the class structure is like etc.) then the SPoE functions are for you.

# Who won't use them #

Coders are definitely going to want to extend classes, pass around references to classes, directly access SQL tables, write joins on tables and so on from other modules. A module designer should not try to stop them doing this. We are not writing Java, after all.

However, all the internals of a module are in constant flux. Tables get normalised and classes get refactored. We are writing software after all: it's meant to be "soft". Code that bypasses the "SPoE" functions and plays around the internals of a module is liable to break if that module is updated.

Bugs that are raised as a result of code bypassing the SPoE classes will be given a much lower priority or even closed immediately.

If this seems a little reckless maybe you should be writing Java. This sort of flexible programming is anathema to many programmers and beloved by others. Haddock (and PHP in general) gives programmers enough rope to hang themselves. It also tries to give safer interfaces to those who would trade performance and flexibility for consistency.