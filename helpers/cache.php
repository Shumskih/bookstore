<?php
header('Cache-control: public');

header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 7 * 24 * 60 * 60) . 'GMT');