/**
 * The default style sheet for a haddock project.
 *
 * Unless you're odd, you won't want to keep this.
 *
 * A good place to override this might be in a file called
 *
 * <DOC_ROOT>/project-specific/public-includes/pages/styles/css/main.inc.php
 *
 * © Clear Line Web Design, 2007-07-19
 */

body {
    font-family: sans-serif;
    
    padding-top: 30px;
    padding-left: 50px;
    padding-right: 50px;
    padding-bottom: 30px;
}

div {
    border: 1px;
    border-color: black;
    border-style: solid;
    
    padding: 0.5em;
    margin: 2px;
}

/*
 * Styles for the various default divs.
 */
div#header {
    background-color: red;
}

div#content {
    background-color: lightblue;
}

div#navigation {
    background-color: yellow;
}

div#footer {
    background-color: lightgreen;
}