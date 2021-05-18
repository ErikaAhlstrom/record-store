<?php
session_start();
session_unset();
session_destroy();
$destination = "http://localhost/record-store/";
header("Location: $destination");