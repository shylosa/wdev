<?php

//Bypassing CORS restrictions
$source = 'https://colorlib.com/wp/template/glint/';

echo file_get_contents($source);