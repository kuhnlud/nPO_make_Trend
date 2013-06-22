nPO_make_Trend
==============

A [nPO_Trend] implementation for nPO.


Usage
-----

A quick example:

In an CMD or ConEmu file Open in This Skript location:

Type:
```php
-> php nPO_Trend.php

```

That's all!

Return will be, in _render Directory, all trend file (.chr, .chr.xml, .chr.rcc)
All are ready to be imported in one nPO Project.

You must create a CSV file with following structur:

Trend_Name;Tag_Name;;Tag_Color;Tag_LowLimit;Tag_HighLimit;Tag_Unit;Tag_Type

with:
-----

Trend_Name: Name from future Trend File.
Tag_Name: Gate Name for one Item of your Trend.
Tag_Color: Color from that Gate.
Tag_LowLimit: Low Limit for that Gate.
Tag_HighLimit: High Limit for that Gate.
Tag_Unit: Unit (°C, %...) for that Gate.
Tag_Type: Type (Linie, Bar) from Gate. -> Default: Linie.
		  ->Current Problem with UTF8 (°C).

See Also
--------
Mustache is an Templating Render Engine. It is used in the project to render Files.
 
 * [Mustache.php wiki](https://github.com/bobthecow/mustache.php/wiki/Home).
 * [mustache(5)](http://mustache.github.com/mustache.5.html) man page.
