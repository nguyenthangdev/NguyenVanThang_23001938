<?php

function escapeHtml($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function formatPrice($price)
{
    return number_format((float) $price, 0, ',', '.') . ' đ';
}
