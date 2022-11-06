<?php

function getCurrentPath(): string
{
    return parse_url($_SERVER['REQUEST_URI'])['path'];
}

return explode("?", explode("/", getCurrentPath())[2])[0];