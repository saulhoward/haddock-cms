# Introduction #

The aim of any framework is to ease the separation of your project into sensible components.

Every PHP hacker starts off whacking out a page of code that goes from PHP to SQL to HTML to JS to CSS to Regex to whatever else. This is often the first step that you take and a couple hundred lines of that sort of thing cobbled together in an hour can be really helpful to get ideas working. That's the beauty of PHP.

e.g.

```
<?php
$dbh = DB::m();
$query = <<<SQL
SELECT
    name
FROM
    foo_bars
SQL;

$result = mysql_query($query, $dbh);

?>
<ul>
<?php while ($row = mysql_fetch_assoc($result)) { ?>
<li><?php echo $row['name']; ?></li>
<?php } ?>
</ul>
<?php
?>
```

The problem with such code is that it's not very reusable. Some people might say that it's not very readable but that's really a question of taste. It is readable in that every line achieves something useful and is understandable. Any PHP programmer could understand such code very quickly.

Programmers often need to extract functionality from such adhoc scripts. Not as an end in itself but in order to reuse code.

e.g.

```
class FooBarTableRenderer
{
    public static function
        render_names_ul($result)
    {
?>
<ul>
<?php while ($row = mysql_fetch_assoc($result)) { ?>
<li><?php echo $row['name']; ?></li>
<?php } ?>
</ul>
<?php
    }
}
```

Such a function can be called all over the place allowing code reuse, which is the **only** point of refactoring code. "Beautiful" object oriented code that uses a thousand nested methods stacked inside themselves that does nothing other that print out HTML is overkill at best and an inflexible maintenance nightmare at worst.

All the functions that are extracted for rendering the display should be static and should avoid further calls to the database if possible. At other points in the code, we might find another way to build our list of names. Perhaps we normalise our database tables and the SQL query uses a join. Who knows. Whatever happens, we want to keep the ability to give our function a result pointer and deal with it.