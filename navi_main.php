<?php
print "
<nav class='main-nav'>
	<ul>
		<li ";
if ($content == 'home') print "class='active' ";
print "><a href='/home.html' title='Home' >Home</a></li>
	</ul>
</nav><!-- /.main-nav -->";

print "
<nav class='mobile-nav'>
	<ul>
		<li ";
if ($content == 'home') print "class='active' ";
print "><a href='/home.html' title='Home' >Home</a></li>
	</ul>
</nav><!-- /.mobile-nav -->";