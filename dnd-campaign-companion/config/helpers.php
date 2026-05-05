<?php
# Function to simplify htmlspecialchars that prevent Cross-Site Scripting
function e($variable){
    return htmlspecialchars($variable, ENT_QUOTES, 'UTF-8');
}
