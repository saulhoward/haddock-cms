# Introduction #

.INC files seem like a good idea but are a maintenance nightmare. They can be avoided completely in Haddock code.

# How are they avoided? #

Everything in Haddock is a class.

An HTML page is a class that extends `Public_HTMLPage`.

If you want to create a new page, you extend that class and override some of the methods, e.g. `render_body_div_content`. Or simply implement the abstract function `content`.

The same is true of command-line scripts.

# But I like .INC files #

Maybe you think that I am imposing my ideas of good design on the framework. Perhaps this goes against the DesignPrinciples of Haddock.

Every other framework out there seems to use templates in someway or another. If you want to use them, you should probably use one of them instead of Haddock.

Haddock is my attempt to get away from such code. There would be no reason to write Haddock if it was going to copy what's already out there.

Of course, you could implement a plug-in for Haddock that used .INC and templates files. But I would need a lot of persuading before I would use it.