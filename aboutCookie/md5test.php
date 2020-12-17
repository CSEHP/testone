<?php
$ms = microtime();
echo $ms;
echo '<hr>';
echo md5('root');
echo '<hr>';
echo md5(md5('root').$ms);
